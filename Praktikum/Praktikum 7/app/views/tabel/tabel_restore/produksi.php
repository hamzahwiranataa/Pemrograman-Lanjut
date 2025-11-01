<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <?php require_once '../app/views/home/header.html'; ?>
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="flash-message <?= $_SESSION['flash_type'] ?? 'success' ?>">
            <?= $_SESSION['flash_message'] ?>
        </div>
        <?php 
        unset($_SESSION['flash_message']);
        unset($_SESSION['flash_type']);
        ?>
    <?php endif; ?>

    <div>
        <h2><i class="fa-solid fa-cogs"></i> Produksi</h2>

        <div class="search-container">
            <form method="POST" action="">
                <input type="hidden" name="view" value="<?= $_GET['view'] ?? '' ?>">
                <input type="text" name="search" class="search-input" placeholder="Cari Produksi" value="<?= $_POST['search'] ?? '' ?>">
                <button type="submit" class="search-btn"><i class="fas fa-search"></i> Cari</button>
            </form>
        </div>
        <div class="table-container">
            <script>
                function toggleCheckboxes(source) {
                    const checkboxes = document.querySelectorAll('input[name="ids[]"]');
                    checkboxes.forEach(cb => cb.checked = source.checked);
                }
            </script>
                
            <form id="bulkForm" method="POST" action="index.php?view=bulk_action">
                <input type="hidden" name="view" value="<?= $_GET['view'] ?? '' ?>">
                <table>
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="select_all" onclick="toggleCheckboxes(this)"></th>
                            <th>NO</th>
                            <th>
                                <?php 
                                    $sort_col = $_GET['sort_col'] ?? '';
                                    $sort_dir = $_GET['sort_dir'] ?? 'ASC';
                                ?>
                                Tanggal
                                <a href="?view=produksi_restore&sort_col=tanggal&sort_dir=<?= ($sort_col == 'tanggal' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                </a>
                            </th>
                            <th>
                                Jumlah Lembar
                                <a href="?view=produksi_restore&sort_col=jumlah_lembar&sort_dir=<?= ($sort_col == 'jumlah_lembar' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                </a>   
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)) : ?>
                            <?php $no = ($page - 1) * $records_per_page + 1; ?>
                            <?php foreach ($data as $row) : ?>
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="<?= $row['id'] ?>"></td>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['tanggal'] ?></td>
                                    <td><?= $row['jumlah_lembar'] ?></td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="10" style="text-align: center;">Tidak ada data yang dihapus</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
        
            <?php
            $total_pages = ceil($total_records / $records_per_page);
            if ($total_pages > 1): ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?view=produksi_restore&page=1<?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&laquo;</a>
                    <a href="?view=produksi_restore&page=<?= $page-1 ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&lsaquo;</a>
                <?php endif; ?>
                
                <?php for($i = max(1, $page-2); $i <= min($page+2, $total_pages); $i++): ?>
                    <?php if($i == $page): ?>
                        <span class="active"><?= $i ?></span>
                    <?php else: ?>
                        <a href="?view=produksi_restore&page=<?= $i ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?view=produksi_restore&page=<?= $page+1 ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&rsaquo;</a>
                    <a href="?view=produksi_restore&page=<?= $total_pages ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&raquo;</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <div class="actions">
                <a href="index.php?view=produksi" class="btn btn-secondary">Kembali</a>
                <button type="submit" name="action" value="restore" class="btn btn-warning"><i class="fas fa-share"></i> Restore Selected</button>
                <button type="submit" name="action" value="delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to permanently delete the selected items?');"><i class="fas fa-trash"></i> Delete Selected</button>
            </div>

            </form>
        </div>
    </div>
</body>
</html>