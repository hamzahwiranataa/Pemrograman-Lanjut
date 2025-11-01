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
        <h2><i class="fa-solid fa-boxes-stacked"></i> Bahan Baku</h2>
        <div class="search-container">
            <form method="POST" action="">
                <input type="hidden" name="view" value="<?= $_GET['view'] ?? '' ?>">
                <input type="text" name="search" class="search-input" placeholder="Cari Bahan Baku" value="<?= $_POST['search'] ?? '' ?>">
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
                        <th><input type="checkbox" name="select_all" onclick="toggleCheckboxes(this )"></th>
                        <th>
                            NO
                        </th>
                        <th>
                            <?php 
                            $sort_col = $_GET['sort_col'] ?? '';
                            $sort_dir = $_GET['sort_dir'] ?? 'ASC';
                            ?>
                            Nama Bahan
                            <a href="?view=bahan_baku&sort_col=nama_bahan&sort_dir=<?= ($sort_col == 'nama_bahan' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                <i class="fa fa-arrows-v"></i>
                            </a>
                        </th>
                        <th>
                            Jenis
                            <a href="?view=bahan_baku&sort_col=jenis&sort_dir=<?= ($sort_col == 'jenis' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                <i class="fa fa-arrows-v"></i>
                            </a>
                        </th>
                        <th>
                            Stok
                            <a href="?view=bahan_baku&sort_col=stok&sort_dir=<?= ($sort_col == 'stok' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                <i class="fa fa-arrows-v"></i>
                            </a>
                        </th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)) : ?>
                        <?php $no = 1; ?>
                        <?php foreach ($data as $row) : ?>
                            
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="<?= $row['id'] ?>" <?= isset($_POST['ids']) && is_array($_POST['ids']) && in_array($row['id'], $_POST['ids']) ? 'checked' : '' ?>></td>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nama_bahan']; ?></td>
                                    <td><?= $row['jenis']; ?></td>
                                    <td><?= $row['stok']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='index.php?view=edit_bahan_baku&id=<?= $row['id']; ?>'"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                
                        <?php endforeach; ?>
                            <?php if ($no == 1): ?>
                                <tr>
                                    <td colspan="5">Belum ada data</td>
                                </tr>
                            <?php endif; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">Belum ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                </table>
        </div>
        <?php
        $total_pages = ceil($total_records / $records_per_page);
        if ($total_pages > 1): ?>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?view=bahan_baku&page=1<?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&laquo;</a>
                <a href="?view=bahan_baku&page=<?= $page-1 ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&lsaquo;</a>
            <?php endif; ?>
            
            <?php for($i = max(1, $page-2); $i <= min($page+2, $total_pages); $i++): ?>
                <?php if($i == $page): ?>
                    <span class="active"><?= $i ?></span>
                <?php else: ?>
                    <a href="?view=bahan_baku&page=<?= $i ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?view=bahan_baku&page=<?= $page+1 ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&rsaquo;</a>
                <a href="?view=bahan_baku&page=<?= $total_pages ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&raquo;</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
                </table>



                <div class="actions">
                    <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" form="bulkForm" name="action" value="delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to mark the selected items for deletion?');">
                        <i class="fas fa-trash"></i> Delete Selected
                    </button>
                    <a class="btn btn-primary" href="index.php?view=tambah_bahan_baku"><i class="fas fa-plus"></i> Tambah Data</a>
                    <a class="btn btn-secondary" href="index.php?view=bahan_baku_restore"><i class="fas fa-share"></i> Restore</a>
                </div>
            </form>
    </div>
</body>
</html>