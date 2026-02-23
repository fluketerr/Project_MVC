<html>

<head>

    <head>
        <style>
            .card {
                background: #ddd;
                padding: 15px;
                margin-bottom: 15px;
                border-radius: 8px;
                cursor: pointer;
            }

            .modal {
                display: none;
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
            }

            .modal-content {
                background: white;
                width: 450px;
                margin: 8% auto;
                padding: 20px;
                border-radius: 10px;
                position: relative;
            }

            .close-btn {
                position: absolute;
                right: 15px;
                top: 10px;
                font-size: 22px;
                cursor: pointer;
            }
        </style>
    </head>
</head>

<body>

    <?php include 'header.php'; ?>

    <main>

        <a href="/home">กิจกรรมทั้งหมด</a>
        <a href="/my_events">กิจกรรมของฉัน</a>

        <p>
            <?= $_SESSION['message'] ?? '' ?>
            <?php unset($_SESSION['message']); ?>
        </p>

        <h2>คำขอเข้าร่วมกิจกรรม (รออนุมัติ)</h2>

        <?php if ($data['regis']->num_rows > 0): ?>

            <?php while ($row = $data['regis']->fetch_object()): ?>

                <?php $uid = $row->uid ?>
                <div class="card"
                    onclick="openModal(
        '<?= htmlspecialchars($row->name) ?>',
        '<?= htmlspecialchars($row->email) ?>',
        '<?= htmlspecialchars($row->tel) ?>',
        '<?= htmlspecialchars($row->birthday ?? '') ?>',
        '<?= htmlspecialchars($row->job ?? '') ?>',
        '<?= htmlspecialchars($row->gender ?? '') ?>',
        '<?= htmlspecialchars($row->address ?? '') ?>',
        '<?= $row->status ?>'
     )">

                    <h3><?= htmlspecialchars($row->name) ?></h3>
                    <p>Email: <?= htmlspecialchars($row->email) ?></p>
                    <p>เบอร์โทร: <?= htmlspecialchars($row->tel) ?></p>
                    <p>Status: <?= $row->status ?></p>                  

                    <!-- ปุ่มกดไม่ให้ไป trigger modal -->
                    <div onclick="event.stopPropagation()">
                        <form method="POST" action="/approve_request" style="display:inline;">
                            <input type="hidden" name="rid" value="<?= (int)$row->rid ?>">
                            <button type="submit">อนุมัติ</button>
                        </form>

                        <form method="POST" action="/reject_request" style="display:inline;">
                            <input type="hidden" name="rid" value="<?= (int)$row->rid ?>">
                            <button type="submit">ปฏิเสธ</button>
                        </form>
                    </div>

                </div>

            <?php endwhile; ?>

        <?php else: ?>
            <p>ไม่มีคำขอที่รออนุมัติ</p>
        <?php endif; ?>

    </main>

    <?php include 'footer.php'; ?>

    <script>
        function openModal(name, email, tel, birthday, job, gender, address, status) {

            document.getElementById("modalName").innerText = name;
            document.getElementById("modalEmail").innerText = email;
            document.getElementById("modalTel").innerText = tel;
            document.getElementById("modalBirthday").innerText = birthday;
            document.getElementById("modalJob").innerText = job;
            document.getElementById("modalGender").innerText = gender;
            document.getElementById("modalAddress").innerText = address;
            document.getElementById("modalStatus").innerText = status;

            document.getElementById("userModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("userModal").style.display = "none";
        }

        window.onclick = function(event) {
            const modal = document.getElementById("userModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

<div id="userModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>

        <h2 id="modalName"></h2>
        <p><strong>Email:</strong> <span id="modalEmail"></span></p>
        <p><strong>วันเกิด:</strong> <span id="modalBirthday"></span></p>
        <p><strong>เบอร์โทร:</strong> <span id="modalTel"></span></p>
        <p><strong>อาชีพ:</strong> <span id="modalJob"></span></p>
        <p><strong>เพศ:</strong> <span id="modalGender"></span></p>
        <p><strong>ที่อยู่:</strong> <span id="modalAddress"></span></p>
        <p><strong>Status:</strong> <span id="modalStatus"></span></p>
    </div>
</div>

</html>