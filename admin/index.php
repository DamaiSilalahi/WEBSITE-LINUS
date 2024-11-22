<?php
require '../config/db.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: sign_in.php");
    exit();
}

$drivers = [];
$buses = [];
$totalBuses = 0;
$totalDriverBus = 0; 
try {
    $stmt = $conn->prepare("SELECT * FROM driver_bus ORDER BY id ASC");
    $stmt->execute();
    $drivers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare("SELECT * FROM bus ORDER BY id ASC");
    $stmt->execute();
    $buses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt = $conn->prepare("SELECT COUNT(*) AS total_buses FROM bus");
    $stmt->execute();
    $totalBuses = $stmt->fetch(PDO::FETCH_ASSOC)['total_buses'];

    $stmt = $conn->prepare("SELECT COUNT(*) AS total_driver_bus FROM driver_bus");
    $stmt->execute();
    $totalDriverBus = $stmt->fetch(PDO::FETCH_ASSOC)['total_driver_bus'];

} catch (PDOException $e) {
    echo "Kesalahan: " . $e->getMessage();
}

if (isset($_POST['update_driver_id']) && isset($_POST['new_username'])) {
    $update_driver_id = $_POST['update_driver_id'];
    $new_username = $_POST['new_username'];

    try {
        $stmt = $conn->prepare("UPDATE driver_bus SET username = :username WHERE id = :id");
        $stmt->bindParam(':username', $new_username);
        $stmt->bindParam(':id', $update_driver_id);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Username berhasil diperbarui']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit();
}

    if (isset($_POST['delete_driver_id'])) {
        $delete_id = $_POST['delete_driver_id'];
        try {
            $stmt = $conn->prepare("DELETE FROM driver_bus WHERE id = :id");
            $stmt->bindParam(':id', $delete_id);
            $stmt->execute();
            echo "<script>alert('Driver berhasil dihapus'); window.location.href='index.php';</script>";
        } catch (PDOException $e) {
            echo "Kesalahan: " . $e->getMessage();
        }
    }

    if (isset($_POST['update_bus_id']) && isset($_POST['new_bus_plate_number'])) {
        $update_id = $_POST['update_bus_id'];
        $new_plate_number = $_POST['new_bus_plate_number'];
        try {
            $stmt = $conn->prepare("UPDATE bus SET plat_nomor = :plat_nomor WHERE id = :id");
            $stmt->bindParam(':plat_nomor', $new_plate_number);
            $stmt->bindParam(':id', $update_id);
            $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Plat nomor berhasil diperbarui']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit();
    }

    if (isset($_POST['add_bus_plate_number'])) {
        $add_plate_number = $_POST['add_bus_plate_number'];
        try {
            $stmt = $conn->prepare("INSERT INTO bus (plat_nomor) VALUES (:plat_nomor)");
            $stmt->bindParam(':plat_nomor', $add_plate_number);
            $stmt->execute();
            echo "<script>alert('Bus baru berhasil ditambahkan'); window.location.href='index.php';</script>";
        } catch (PDOException $e) {
            echo "Kesalahan: " . $e->getMessage();
        }
    }

    if (isset($_POST['delete_bus_id'])) {
        $delete_id = $_POST['delete_bus_id'];
        try {
            $stmt = $conn->prepare("DELETE FROM bus WHERE id = :id");
            $stmt->bindParam(':id', $delete_id);
            $stmt->execute();
            echo "<script>alert('Bus berhasil dihapus'); window.location.href='index.php';</script>";
        } catch (PDOException $e) {
            echo "Kesalahan: " . $e->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Data Driver & Bus</title>
    <script>
        function showTable(tableId) {
            const tables = document.querySelectorAll('.table-container');
            tables.forEach(table => table.classList.remove('active'));
            document.getElementById(tableId).classList.add('active');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="admin.css">
     
</head>
<body>
<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Menu Admin</a>
                </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="javascript:void(0);" onclick="showTable('dashboard')"  class="sidebar-link">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
            </li>
            <li>    
                <a href="javascript:void(0);" onclick="showTable('driverBusTable')" class="sidebar-link">
                    <i class="fa fa-user"></i>
                    <span>Data Driver Bus</span></a>
            </li>
            <li class="sidebar-item">
                <a href="javascript:void(0);" onclick="showTable('busTable')" class="sidebar-link">
                <i class="fa fa-bus"></i>
                    <span>Data Bus</span>
                </a>
            </li>
            <div class="sidebar-footer">
                <a href="sign_out.php" class="sidebar-link">
                    <i class="fa fa-sign-out" ></i>
                    <span>Logout</span>
                </a>
                </a>
            </div>
            
        </ul>
    </aside>

    <div class="content">
        <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>

        <div id="dashboard" class="table-container active">
            <h3>Dashboard</h3>
            <div class="dashboard-box">
                <div class="box">
                    <h4>Total Jumlah Bus</h4>
                    <p><?php echo $totalBuses; ?> Bus</p>
                </div>
                <div class="box">
                    <h4>Total Jumlah Driver Bus</h4>
                    <p><?php echo $totalDriverBus; ?> Driver Bus</p>
                </div>
            </div>
        </div>

        <div id="driverBusTable" class="table-container">
            <h3>Kelola Data Driver</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($drivers)): ?>
                        <?php foreach ($drivers as $index => $driver): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($driver['username']); ?></td>
                                <td><?php echo isset($driver['is_active']) && $driver['is_active'] ? '<span style="color: green;">Aktif</span>' : '<span style="color: red;">Non-Aktif</span>'; ?></td>
                                <td>
                                    <button type="button" onclick="updateDriver('<?php echo $driver['id']; ?>', '<?php echo $driver['username']; ?>')">Update</button>
                                </td>
                                <td>
                                    <button type="button" onclick="confirmDeleteDriver(<?php echo $driver['id']; ?>)">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5">Tidak ada data driver.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div id="busTable" class="table-container">
            <h3>Kelola Data Bus</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Plat Nomor</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($buses)): ?>
                        <?php foreach ($buses as $index => $bus): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($bus['plat_nomor']); ?></td>
                                <td>
                                    <button type="button" onclick="updateBus('<?php echo $bus['id']; ?>', '<?php echo $bus['plat_nomor']; ?>')">Update</button>
                                </td>
                                <td>
                                    <button type="button" onclick="confirmDeleteBus(<?php echo $bus['id']; ?>)">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4">Tidak ada data bus.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <script>
        function confirmDeleteDriver(driverId) {
    Swal.fire({
        title: 'Konfirmasi Penghapusan',
        text: "Apakah Anda yakin ingin menghapus driver ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `delete_driver_id=${driverId}`
            })
            .then(response => response.text())
            .then(() => {
                Swal.fire(
                    'Berhasil!',
                    'Driver berhasil dihapus.',
                    'success'
                ).then(() => location.reload());
            })
            .catch(() => {
                Swal.fire(
                    'Gagal!',
                    'Terjadi kesalahan saat menghapus driver.',
                    'error'
                );
            });
        }
    });
}

function confirmDeleteBus(busId) {
    Swal.fire({
        title: 'Konfirmasi Penghapusan',
        text: "Apakah Anda yakin ingin menghapus bus ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `delete_bus_id=${busId}`
            })
            .then(response => response.text())
            .then(() => {
                Swal.fire(
                    'Berhasil!',
                    'Bus berhasil dihapus.',
                    'success'
                ).then(() => location.reload());
            })
            .catch(() => {
                Swal.fire(
                    'Gagal!',
                    'Terjadi kesalahan saat menghapus bus.',
                    'error'
                );
            });
        }
    });
}



        function showUpdateBusForm(busId, platNomor) {
            document.getElementById('updateBusForm_' + busId).style.display = 'inline';
            document.getElementById('updateBusButton_' + busId).style.display = 'none';
            document.getElementById('busPlateInput_' + busId).value = platNomor;
        }

        function cancelUpdateBus(busId) {
            document.getElementById('updateBusForm_' + busId).style.display = 'none';
            document.getElementById('updateBusButton_' + busId).style.display = 'inline';
        }

        function updateDriver(driverId, currentUsername) {
    Swal.fire({
        title: 'Perbarui Username',
        input: 'text',
        inputLabel: 'Masukkan username baru:',
        inputValue: currentUsername,
        showCancelButton: true,
        confirmButtonText: 'Lanjut',
        cancelButtonText: 'Batal',
        inputValidator: (value) => {
            if (!value) {
                return 'Username tidak boleh kosong!';
            }
        }
    }).then((inputResult) => {
        if (inputResult.isConfirmed) {
            const newUsername = inputResult.value;

            Swal.fire({
                title: "Apakah Anda ingin menyimpan perubahan?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Simpan",
                denyButtonText: "Jangan simpan"
            }).then((confirmResult) => {
                if (confirmResult.isConfirmed) {
                    fetch('', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `update_driver_id=${driverId}&new_username=${encodeURIComponent(newUsername)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire("Berhasil!", data.message, "success").then(() => {
                                location.reload(); // Muat ulang halaman setelah SweetAlert selesai
                            });
                        } else {
                            Swal.fire("Gagal!", data.message, "error");
                        }
                    })
                    .catch(error => {
                        Swal.fire("Error!", "Terjadi kesalahan dalam pengiriman data.", "error");
                    });
                } else if (confirmResult.isDenied) {
                    Swal.fire("Perubahan tidak disimpan", "", "info");
                }
            });
        }
    });
}


    function updateBus(busId, currentPlatNomor) {
        Swal.fire({
            title: 'Perbarui Plat Nomor',
            input: 'text',
            inputLabel: 'Masukkan plat nomor baru:',
            inputValue: currentPlatNomor,
            showCancelButton: true,
            confirmButtonText: 'Lanjut',
            cancelButtonText: 'Batal',
            inputValidator: (value) => {
                if (!value) {
                    return 'Plat nomor tidak boleh kosong!';
                }
            }
        }).then((inputResult) => {
            if (inputResult.isConfirmed) {
                const newBusPlateNumber = inputResult.value;

                Swal.fire({
                    title: "Apakah Anda ingin menyimpan perubahan?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Simpan",
                    denyButtonText: "Jangan simpan"
                }).then((confirmResult) => {
                    if (confirmResult.isConfirmed) {
                        fetch('', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: `update_bus_id=${busId}&new_bus_plate_number=${encodeURIComponent(newBusPlateNumber)}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire("Berhasil!", data.message, "success").then(() => {
                                    location.reload(); 
                                });
                            } else {
                                Swal.fire("Gagal!", data.message, "error");
                            }
                        })
                        .catch(error => {
                            Swal.fire("Error!", "Terjadi kesalahan dalam pengiriman data.", "error");
                        });
                    } else if (confirmResult.isDenied) {
                        Swal.fire("Perubahan tidak disimpan", "", "info");
                    }
                });
            }
        });
    }


    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="admin.js"></script>
</body>
</html>

