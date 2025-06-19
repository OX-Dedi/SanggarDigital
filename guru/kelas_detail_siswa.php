<?php
session_start();
include '../config/db.php';

$user_id = $_SESSION['user_id'] ?? null;
$user_role = $_SESSION['user_role'] ?? null;

if (!isset($_GET['id'])) {
    die("ID kelas tidak ditemukan.");
}
$kelas_id = intval($_GET['id']);

$kelas_result = mysqli_query($conn, "
    SELECT k.*, u.name AS nama_guru 
    FROM kelas k 
    JOIN users u ON k.guru_id = u.id 
    WHERE k.id = $kelas_id
");
$kelas = mysqli_fetch_assoc($kelas_result);
if (!$kelas) die("Kelas tidak ditemukan.");

if (isset($_POST['submit_materi']) && $user_role == 'guru') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $penjelasan = mysqli_real_escape_string($conn, $_POST['penjelasan']);
    $link_video = mysqli_real_escape_string($conn, $_POST['link_video']);
    $link_zoom = mysqli_real_escape_string($conn, $_POST['link_zoom']);
    $link_absen = mysqli_real_escape_string($conn, $_POST['link_absen']);
    $video_belajar = mysqli_real_escape_string($conn, $_POST['video_belajar']);
    $file_materi = null;

    if (!empty($_FILES['file_materi']['name'])) {
        $target_dir = "../guru/uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);
        $file_name = time() . "_" . basename($_FILES['file_materi']['name']);
        $target_file = $target_dir . $file_name;
        if (move_uploaded_file($_FILES["file_materi"]["tmp_name"], $target_file)) {
            $file_materi = "guru/uploads/" . $file_name;
        }
    }

    $query = "INSERT INTO materi (kelas_id, judul, penjelasan, file_materi, link_video, link_zoom, link_absen, video_belajar) VALUES (
        $kelas_id,
        '$judul',
        '$penjelasan',
        " . ($file_materi ? "'$file_materi'" : "NULL") . ",
        " . ($link_video ? "'$link_video'" : "NULL") . ",
        " . ($link_zoom ? "'$link_zoom'" : "NULL") . ",
        " . ($link_absen ? "'$link_absen'" : "NULL") . ",
        " . ($video_belajar ? "'$video_belajar'" : "NULL") . "
    )";

    mysqli_query($conn, $query);
    header("Location: kelas_detail.php?id=$kelas_id");
    exit;
}

if (isset($_POST['submit_diskusi'])) {
$isi = mysqli_real_escape_string($conn, $_POST['isi']);
$parent_id = (isset($_POST['parent_id']) && $_POST['parent_id'] !== '') ? intval($_POST['parent_id']) : 'NULL';

mysqli_query($conn, "INSERT INTO diskusi (kelas_id, user_id, isi, parent_id) VALUES ($kelas_id, $user_id, '$isi', $parent_id)");
    header("Location: kelas_detail_siswa.php?id=$kelas_id#diskusi");
    exit;
}

$materi_result = mysqli_query($conn, "SELECT * FROM materi WHERE kelas_id = $kelas_id ORDER BY created_at DESC");

$diskusi_result = mysqli_query($conn, "
    SELECT d.*, u.name 
    FROM diskusi d 
    JOIN users u ON d.user_id = u.id 
    WHERE d.kelas_id = $kelas_id AND d.parent_id IS NULL 
    ORDER BY d.waktu DESC
");

$reply_result = mysqli_query($conn, "
    SELECT d.*, u.name 
    FROM diskusi d 
    JOIN users u ON d.user_id = u.id 
    WHERE d.kelas_id = $kelas_id AND d.parent_id IS NOT NULL 
    ORDER BY d.waktu ASC
");

$replies = [];
while ($r = mysqli_fetch_assoc($reply_result)) {
    $replies[$r['parent_id']][] = $r;
}

function convertYoutubeToEmbed($url) {
    $host = parse_url($url, PHP_URL_HOST);
    if (strpos($host, 'youtube.com') !== false) {
        parse_str(parse_url($url, PHP_URL_QUERY), $query);
        if (isset($query['v'])) {
            return "https://www.youtube.com/embed/" . $query['v'];
        }
    } elseif (strpos($host, 'youtu.be') !== false) {
        $path = trim(parse_url($url, PHP_URL_PATH), '/');
        return "https://www.youtube.com/embed/" . $path;
    }
    return $url;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Kelas: <?= htmlspecialchars($kelas['nama_kelas']) ?></title>
    <link rel="stylesheet" href="kelas_detail.css" />
    <script>
        function toggleFormMateri() {
            const form = document.getElementById('form-materi');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        function replyTo(id) {
            document.getElementById('parent_id').value = id;
            document.getElementById('isi').focus();
        }
    </script>
    <style>
.btn-reply {
    background-color: #f8f9fa;
    border: 1px solid #ccc;
    color: #444;
    font-size: 0.7rem;
    padding: 3px 6px;
    border-radius: 4px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: background-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
    margin-top: 4px;
}

.btn-reply:hover {
    background-color: #e9ecef;
    color: #222;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08);
}


</style>
</head>
<body>

<div class="container">
    <div class="header">
        <a href="../kelas_siswa/kelas_saya.php" style="display:inline-block; margin-bottom:10px;">
            <button style="padding:8px 16px; background-color:#3498db; color:white; border:none; border-radius:5px; cursor:pointer;">← Kembali</button>
        </a>

        <h2><?= htmlspecialchars($kelas['nama_kelas']) ?></h2>
        <p><?= htmlspecialchars($kelas['deskripsi']) ?></p>
        <small>Dibimbing oleh: <strong><?= htmlspecialchars($kelas['nama_guru']) ?></strong></small>
    </div>

    <div class="content">
        <section class="left">
            <h3>📚 Materi Kelas</h3>

            <?php if (mysqli_num_rows($materi_result) == 0): ?>
                <p>Belum ada materi yang ditambahkan.</p>
            <?php else: ?>
                <?php while ($m = mysqli_fetch_assoc($materi_result)) : ?>
                    <article class="materi-item">
                        <strong><?= htmlspecialchars($m['judul']) ?></strong>
                        <p><?= nl2br(htmlspecialchars($m['penjelasan'])) ?></p>

                        <div class="materi-links">
                            <?php if ($m['file_materi']): ?>
                                📎 <a href="<?= htmlspecialchars($m['file_materi']) ?>" target="_blank">Download File</a>
                            <?php endif; ?>
                            <?php if ($m['link_video']): ?>
                                <div class="video-frame">
                                    <iframe width="560" height="315" src="<?= htmlspecialchars(convertYoutubeToEmbed($m['link_video'])) ?>" frameborder="0" allowfullscreen></iframe>
                                </div>
                            <?php endif; ?>
                            <?php if ($m['link_zoom']): ?>
                                🔗 <a href="<?= htmlspecialchars($m['link_zoom']) ?>" target="_blank">Link Zoom</a>
                            <?php endif; ?>
                            <?php if ($m['link_absen']): ?>
                                📝 <a href="<?= htmlspecialchars($m['link_absen']) ?>" target="_blank">Link Absen</a>
                            <?php endif; ?>
                            <?php if ($m['video_belajar']): ?>
                                <div class="video-frame">
                                    <iframe width="560" height="315" src="<?= htmlspecialchars(convertYoutubeToEmbed($m['video_belajar'])) ?>" frameborder="0" allowfullscreen></iframe>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php endif; ?>

            <?php if ($user_role === 'guru'): ?>
                <button onclick="toggleFormMateri()">➕ Tambah Materi</button>

                <div id="form-materi" style="display:none;">
                    <form method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="form-group">
                            <label for="judul">Judul Materi</label>
                            <input type="text" name="judul" id="judul" required />
                        </div>
                        <div class="form-group">
                            <label for="penjelasan">Penjelasan</label>
                            <textarea name="penjelasan" id="penjelasan" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file_materi">Upload File (opsional)</label>
                            <input type="file" name="file_materi" id="file_materi" />
                        </div>
                        <div class="form-group">
                            <label for="link_video">Link Video</label>
                            <input type="url" name="link_video" id="link_video" />
                        </div>
                        <div class="form-group">
                            <label for="link_zoom">Link Zoom</label>
                            <input type="url" name="link_zoom" id="link_zoom" />
                        </div>
                        <div class="form-group">
                            <label for="link_absen">Link Absen</label>
                            <input type="url" name="link_absen" id="link_absen" />
                        </div>
                        <div class="form-group">
                            <label for="video_belajar">Video Belajar</label>
                            <input type="url" name="video_belajar" id="video_belajar" />
                        </div>

                        <button type="submit" name="submit_materi">Simpan Materi</button>
                    </form>
                </div>
            <?php endif; ?>
        </section>

        <section class="right" id="diskusi">
            <h3>💬 Diskusi Kelas</h3>

            <form method="POST" autocomplete="off" id="form-diskusi">
                <input type="hidden" name="parent_id" id="parent_id" value="" />
                <div class="form-group">
                    <label for="isi">Tulis Diskusi</label>
                    <textarea name="isi" id="isi" rows="3" required></textarea>
                </div>
                <button type="submit" name="submit_diskusi">Kirim Diskusi</button>
            </form>

            <hr />

            <div class="diskusi-list">
                <?php if (mysqli_num_rows($diskusi_result) == 0): ?>
                    <p>Belum ada diskusi.</p>
                <?php else: ?>
                    <?php while ($d = mysqli_fetch_assoc($diskusi_result)): ?>
                        <article class="diskusi-item">
                            <strong><?= htmlspecialchars($d['name']) ?></strong> <small>(<?= $d['waktu'] ?>)</small>
                            <p><?= nl2br(htmlspecialchars($d['isi'])) ?></p>
                            <button class="btn-reply" onclick="replyTo(<?= $d['id'] ?>)">Balas</button>

                            <?php if (isset($replies[$d['id']])): ?>
                                <div class="reply-list" style="margin-left: 20px; margin-top:10px;">
                                    <?php foreach ($replies[$d['id']] as $r): ?>
                                        <div class="reply-item" style="border-left: 2px solid #ccc; padding-left:10px; margin-bottom:10px;">
                                            <strong><?= htmlspecialchars($r['name']) ?></strong> <small>(<?= $r['waktu'] ?>)</small>
                                            <p><?= nl2br(htmlspecialchars($r['isi'])) ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </article>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>

</body>
</html>
