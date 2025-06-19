<?php
include __DIR__ . '/../partials/auth_check.php';
include __DIR__ . '/../partials/navbaradmin.php';
include __DIR__ . '/../partials/sidebaradmin.php';
include '../config/db.php';

if (isset($_POST['approve'])) {
    $id = intval($_POST['id']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $stmt = $conn->prepare("UPDATE pesanan_course SET status='disetujui', feedback_admin=? WHERE id=?");
    $stmt->bind_param("si", $feedback, $id);
    $stmt->execute();
}

if (isset($_POST['reject'])) {
    $id = intval($_POST['id']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $stmt = $conn->prepare("UPDATE pesanan_course SET status='ditolak', feedback_admin=? WHERE id=?");
    $stmt->bind_param("si", $feedback, $id);
    $stmt->execute();
}

$result = mysqli_query($conn, "SELECT p.*, c.nama_course FROM pesanan_course p JOIN course c ON p.course_id = c.id ORDER BY p.created_at DESC");
?>

<style>
    body {
        background-color: #1f2937;
        color: white;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
    }

    main {
        background-color: #1f2937;
        padding: 2rem;
        margin-left: 220px;
        margin-top: 60px;
        min-height: calc(100vh - 60px);
        overflow-y: auto;
    }

    h2 {
        font-size: 2.2rem;
        margin-bottom: 1.5rem;
        font-weight: 700;
        border-left: 6px solid #3b82f6;
        padding-left: 1rem;
        color: #3b82f6;
    }

   .table-container {
    background-color: #111827;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 0 20px #2563eb88;
    color: white;
    overflow-x: auto; 
}

table {
    width: 100%;
    max-width: 100%; 
    border-collapse: collapse;
    margin-top: 1rem;
}

    th, td {
        border: 1px solid #374151;
        padding: 1rem;
        text-align: left;
    }

    th {
        background-color: #1f2937;
        color: #3b82f6;
        font-weight: 600;
    }

    td a {
        color: #3b82f6;
        text-decoration: underline;
    }

    form textarea {
        width: 100%;
        background: #1f2937;
        color: white;
        border: 1px solid #374151;
        border-radius: 5px;
        padding: 0.5rem;
        resize: vertical;
    }

    .btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 0.5rem;
        margin-right: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-approve {
        background-color: #22c55e;
        color: white;
    }

    .btn-approve:hover {
        background-color: #16a34a;
    }

    .btn-reject {
        background-color: #ef4444;
        color: white;
    }

    .btn-reject:hover {
        background-color: #b91c1c;
    }
</style>

<main>
    <h2>Pesanan Course - Admin</h2>

    <div class="table-container">
        <table>
            <tr>
                <th>Course</th>
                <th>Username</th>
                <th>Email</th>
                <th>Bukti Transfer</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['nama_course']) ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td>
                    <?php if ($row['bukti_transfer']) : ?>
                        <a href="<?= $row['bukti_transfer'] ?>" target="_blank">Lihat Bukti</a>
                    <?php else: ?>
                        Tidak Ada
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row['status']) ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <textarea name="feedback" placeholder="Masukkan feedback..." required></textarea><br>
                        <button type="submit" name="approve" class="btn btn-approve">Setujui</button>
                        <button type="submit" name="reject" class="btn btn-reject">Tolak</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</main>
