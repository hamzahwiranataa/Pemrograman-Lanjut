<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>  
    <?php require_once 'header.html'; ?>

  
        <div id="mesin" class="page <?= ($_GET['view'] ?? '')=='mesin_restore' ? 'active' : '' ?>">
            <h2><i class="fas fa-gear"></i> Mesin</h2>
            <div class="search-container">
                <form method="POST" action="">
                    <input type="hidden" name="view" value="<?= $_GET['view'] ?? '' ?>">
                    <input type="text" name="search" class="search-input" placeholder="Cari Nama Mesin" value="<?= $_GET['search'] ?? '' ?>">
                    <button type="submit" class="search-btn"><i class="fas fa-search"></i> Cari</button>
                </form>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>
                                <?php 
                                $sort_col = $_GET['sort_col'] ?? '';
                                $sort_dir = $_GET['sort_dir'] ?? 'ASC';
                                $next_dir = ($sort_col == 'nama_mesin' && $sort_dir == 'ASC') ? 'DESC' : 'ASC';
                                ?>
                                Nama Mesin
                                <a href="?view=mesin_restore&sort_col=nama_mesin&sort_dir=<?= $next_dir ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                </a>
                            </th>
                            <th>
                                Kapasitas Per Jam
                                <a href="?view=mesin_restore&sort_col=kapasitas_per_jam&sort_dir=<?= ($sort_col == 'kapasitas_per_jam' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                </a>
                            </th>
                            <th>
                                Tahun Pembuatan
                                <a href="?view=mesin_restore&sort_col=tahun_pembuatan&sort_dir=<?= ($sort_col == 'tahun_pembuatan' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                </a>
                            </th>
                            <th>Aksi</th>
                        </tr>
                        <tbody>
                            <?php if (!empty($data)) : ?>
                                <?php $no = 1; ?>
                                <?php foreach ($data as $row) : ?>
                                    
                                    
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama_mesin']; ?></td>
                                        <td><?= $row['kapasitas_per_jam']; ?></td>
                                        <td><?= $row['tahun_pembuatan']; ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" onclick="window.location.href='index.php?view=mesin_restore_data&id=<?= $row['id']; ?>'"><i class="fas fa-share"></i></button>
                                        </td>
                                    </tr>
                                    
                                <?php endforeach; ?>
                                <?php if ($no == 1): ?>
                                    <tr>
                                        <td colspan="4">Belum ada data</td>
                                    </tr>
                                <?php endif; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4">Belum ada data</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                </table>
            </div>
            <?php
            if ($total_pages > 1): ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?view=mesin_restore&page=1<?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&laquo;</a>
                    <a href="?view=mesin_restore&page=<?= $page-1 ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&lsaquo;</a>
                <?php endif; ?>
                
                <?php for($i = max(1, $page-2); $i <= min($page+2, $total_pages); $i++): ?>
                    <?php if($i == $page): ?>
                        <span class="active"><?= $i ?></span>
                    <?php else: ?>
                        <a href="?view=mesin_restore&page=<?= $i ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?view=mesin_restore&page=<?= $page+1 ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&rsaquo;</a>
                    <a href="?view=mesin_restore&page=<?= $total_pages ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&raquo;</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="actions">
                <a href="index.php?view=mesin" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
            <div id="barang" class="page <?= ($_GET['view'] ?? '')=='bahan_baku_restore' ? 'active' : '' ?>">
            <h2><i class="fa-solid fa-boxes-stacked"></i> Bahan Baku</h2>
            <div class="search-container">
                <form method="POST" action="">
                    <input type="hidden" name="view" value="<?= $_GET['view'] ?? '' ?>">
                    <input type="text" name="search" class="search-input" placeholder="Cari Bahan Baku" value="<?= $_POST['search'] ?? '' ?>">
                    <button type="submit" class="search-btn"><i class="fas fa-search"></i> Cari</button>
                </form>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>
                                Nama Bahan
                                <a href="?view=bahan_baku_restore&sort_col=nama_bahan&sort_dir=<?= ($sort_col == 'nama_bahan' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                    <?php if($sort_col == 'nama_bahan'): ?>
                                        
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                Jenis
                                <a href="?view=bahan_baku_restore&sort_col=jenis&sort_dir=<?= ($sort_col == 'jenis' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                    <?php if($sort_col == 'jenis'): ?>
                                        
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                Stok
                                <a href="?view=bahan_baku_restore&sort_col=stok&sort_dir=<?= ($sort_col == 'stok' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                    <?php if($sort_col == 'stok'): ?>
                                        
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)) : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($data as $row) : ?>
                                
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama_bahan']; ?></td>
                                        <td><?= $row['jenis']; ?></td>
                                        <td><?= $row['stok']; ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" onclick="window.location.href='index.php?view=bahan_baku_restore_data&id=<?= $row['id']; ?>'"><i class="fas fa-share"></i></button>
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
            if ($total_pages > 1): ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?view=bahan_baku_restore&page=1<?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&laquo;</a>
                    <a href="?view=bahan_baku_restore&page=<?= $page-1 ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&lsaquo;</a>
                <?php endif; ?>
                
                <?php for($i = max(1, $page-2); $i <= min($page+2, $total_pages); $i++): ?>
                    <?php if($i == $page): ?>
                        <span class="active"><?= $i ?></span>
                    <?php else: ?>
                        <a href="?view=bahan_baku_restore&page=<?= $i ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?view=bahan_baku_restore&page=<?= $page+1 ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&rsaquo;</a>
                    <a href="?view=bahan_baku_restore&page=<?= $total_pages ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&raquo;</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="actions">
                <a href="index.php?view=bahan_baku" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>

         <div id="kategori" class="page <?= ($_GET['view'] ?? '')=='operator_restore' ? 'active' : '' ?>">
            <h2><i class="fa-solid fa-users"></i> Operator</h2>
            <div class="search-container">
                <form method="POST" action="">
                    <input type="hidden" name="view" value="<?= $_GET['view'] ?? '' ?>">
                    <input type="text" name="search" class="search-input" placeholder="Cari Nama" value="<?= $_POST['search'] ?? '' ?>">
                    <button type="submit" class="search-btn"><i class="fas fa-search"></i> Cari</button>
                </form>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>
                                Nama
                                <a href="?view=operator_restore&sort_col=nama&sort_dir=<?= ($sort_col == 'nama' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                    <?php if($sort_col == 'nama'): ?>
                                        
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                Shift
                                <a href="?view=operator_restore&sort_col=shift&sort_dir=<?= ($sort_col == 'shift' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                    <?php if($sort_col == 'shift'): ?>
                                        
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>Nomor</th>
                            <th>Aksi</th>   
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)) : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($data as $row) : ?>
                                
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= $row['shift']; ?></td>
                                        <td></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" onclick="window.location.href='index.php?view=operator_restore_data&id=<?= $row['id'] ?>'"><i class="fas fa-share"></i></button>
                                        </td>
                                    </tr>
                              
                            <?php endforeach; ?>
                            <?php if ($no == 1): ?>
                                <tr>
                                    <td colspan="4">Belum ada data</td>
                                </tr>
                            <?php endif; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">Belum ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php
            if ($total_pages > 1): ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?view=operator_restore&page=1<?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&laquo;</a>
                    <a href="?view=operator_restore&page=<?= $page-1 ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&lsaquo;</a>
                <?php endif; ?>
                
                <?php for($i = max(1, $page-2); $i <= min($page+2, $total_pages); $i++): ?>
                    <?php if($i == $page): ?>
                        <span class="active"><?= $i ?></span>
                    <?php else: ?>
                        <a href="?view=operator_restore&page=<?= $i ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?view=operator_restore&page=<?= $page+1 ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&rsaquo;</a>
                    <a href="?view=operator_restore&page=<?= $total_pages ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&raquo;</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="actions">
                <a href="index.php?view=operator" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>

        <div id="produksi" class="page <?= ($_GET['view'] ?? '')=='produksi_restore' ? 'active' : '' ?>">
            <h2><i class="fa-solid fa-cogs"></i> Produksi</h2>
            <div class="search-container">
                <form method="POST" action="">
                    <input type="hidden" name="view" value="<?= $_GET['view'] ?? '' ?>">
                    <input type="text" name="search" class="search-input" placeholder="Cari Jumlah Lembar" value="<?= $_POST['search'] ?? '' ?>">
                    <button type="submit" class="search-btn"><i class="fas fa-search"></i> Cari</button>
                </form>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>
                                Tanggal
                                <a href="?view=produksi_restore&sort_col=tanggal&sort_dir=<?= ($sort_col == 'tanggal' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                    <?php if($sort_col == 'tanggal'): ?>
                                        
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                Jumlah Lembar
                                <a href="?view=produksi_restore&sort_col=jumlah_lembar&sort_dir=<?= ($sort_col == 'jumlah_lembar' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                    <?php if($sort_col == 'jumlah_lembar'): ?>
                                        
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                Mesin ID
                                <a href="?view=produksi_restore&sort_col=mesin_id&sort_dir=<?= ($sort_col == 'mesin_id' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                    <?php if($sort_col == 'mesin_id'): ?>
                                        
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                Bahan ID
                                <a href="?view=produksi_restore&sort_col=bahan_id&sort_dir=<?= ($sort_col == 'bahan_id' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                    <?php if($sort_col == 'bahan_id'): ?>
                                        
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                Operator ID
                                <a href="?view=produksi_restore&sort_col=operator_id&sort_dir=<?= ($sort_col == 'operator_id' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                    <?php if($sort_col == 'operator_id'): ?>
                                        
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)) : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($data as $row) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['tanggal']; ?></td>
                                    <td><?= $row['jumlah_lembar']; ?></td>
                                    <td><?= $row['mesin_id']; ?></td>
                                    <td><?= $row['bahan_id']; ?></td>
                                    <td><?= $row['operator_id']; ?></td>
                                    <td><button class="btn btn-warning btn-sm" onclick="window.location.href='index.php?view=produksi_restore_data&id=<?= $row['id']; ?>'"><i class="fas fa-share"></i></button></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">Belum ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php
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
                <a href="index.php?view=produksi" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    
       <div id="quality_check" class="page <?= ($_GET['view'] ?? '')=='quality_check_restore' ? 'active' : '' ?>">
            <h2><i class="fa-solid fa-circle-check"></i> Quality Check</h2>
            <div class="search-container">
                <form method="POST" action="">
                    <input type="hidden" name="view" value="<?= $_GET['view'] ?? '' ?>">
                    <input type="text" name="search" class="search-input" placeholder="Cari Catatan" value="<?= $_POST['search'] ?? '' ?>">
                    <button type="submit" class="search-btn"><i class="fas fa-search"></i> Cari</button>
                </form>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>
                                Produksi ID
                                <a href="?view=quality_check_restore&sort_col=produksi_id&sort_dir=<?= ($sort_col == 'produksi_id' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                    <?php if($sort_col == 'produksi_id'): ?>
                                        
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                Tingkat Cacat
                                <a href="?view=quality_check_restore&sort_col=tingkat_cacat&sort_dir=<?= ($sort_col == 'tingkat_cacat' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                    <?php if($sort_col == 'tingkat_cacat'): ?>
                                        
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                Jumlah
                                <a href="?view=quality_check_restore&sort_col=jumlah&sort_dir=<?= ($sort_col == 'jumlah' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                    <?php if($sort_col == 'jumlah'): ?>
                                        
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                Status
                                <a href="?view=quality_check_restore&sort_col=status&sort_dir=<?= ($sort_col == 'status' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                    <?php if($sort_col == 'status'): ?>
                                        
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                Catatan
                                <a href="?view=quality_check_restore&sort_col=catatan&sort_dir=<?= ($sort_col == 'catatan' && $sort_dir == 'ASC') ? 'DESC' : 'ASC' ?>" style="color:white;">
                                    <i class="fa fa-arrows-v"></i>
                                    <?php if($sort_col == 'catatan'): ?>
                                        
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)) : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($data as $row) : ?>
                                
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['produksi_id']; ?></td>
                                        <td><?= $row['tingkat_cacat']; ?>%</td>
                                        <td><?= $row['jumlah']; ?></td>
                                        <td><?= $row['status']; ?></td>
                                        <td><?= $row['catatan']; ?></td>    
                                        <td>
                                            <button class="btn btn-warning btn-sm" onclick="window.location.href='index.php?view=quality_check_restore_data&id=<?= $row['id']; ?>'"><i class="fas fa-share"></i></button>
                                        </td>
                                    </tr>
                               
                            <?php endforeach; ?>
                            <?php if ($no == 1): ?>
                                <tr>
                                    <td colspan="7">Belum ada data</td>
                                </tr>
                            <?php endif; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">Belum ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php
            if ($total_pages > 1): ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?view=quality_check_restore&page=1<?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&laquo;</a>
                    <a href="?view=quality_check_restore&page=<?= $page-1 ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&lsaquo;</a>
                <?php endif; ?>
                
                <?php for($i = max(1, $page-2); $i <= min($page+2, $total_pages); $i++): ?>
                    <?php if($i == $page): ?>
                        <span class="active"><?= $i ?></span>
                    <?php else: ?>
                        <a href="?view=quality_check_restore&page=<?= $i ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?view=quality_check_restore&page=<?= $page+1 ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&rsaquo;</a>
                    <a href="?view=quality_check_restore&page=<?= $total_pages ?><?= isset($_GET['sort_col']) ? '&sort_col='.$_GET['sort_col'].'&sort_dir='.$_GET['sort_dir'] : '' ?>">&raquo;</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="actions">
                <a href="index.php?view=quality_check" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>        
<?php require_once 'footer.html'; ?>
</body>
</html>