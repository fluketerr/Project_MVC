<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update_user</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@900&family=Sarabun:wght@400;500;600&display=swap"
        rel="stylesheet">
    <style>
    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    :root {
        --c1: #213C51;
        --c2: #DDAED3;
        --btn: #4b5563;
        --btn-h: #374151;
    }

    body {
        font-family: 'Sarabun', sans-serif;
        min-height: 100vh;
        background: linear-gradient(to bottom, #EEEEEE, #888888);
        overflow: hidden;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ─── BG: fixed full-screen, rotated inner wrapper ─── */
    .bg {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 0;
        overflow: hidden;
    }

    .bg-inner {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 400vmax;
        height: 400vmax;
        transform: translate(-50%, -50%) rotate(-45deg);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .bg-row {
        display: flex;
        align-items: center;
        white-space: nowrap;
        font-family: 'Inter', 'Arial Black', sans-serif;
        font-weight: 900;
        font-size: 90px;
        line-height: 1.0;
        letter-spacing: -0.01em;
        text-transform: uppercase;
        flex-shrink: 0;
    }

    .word {
        display: inline-flex;
        align-items: baseline;
        margin-right: 0.3em;
    }

    .w-c1 .fill {
        color: #213C51;
    }

    .w-c2 .fill {
        color: #DDAED3;
    }

    .w-c1 .outline {
        -webkit-text-stroke: 2px #213C51;
        -webkit-text-fill-color: transparent;
    }

    .w-c2 .outline {
        -webkit-text-stroke: 2px #DDAED3;
        -webkit-text-fill-color: transparent;
    }

    /* ─── Panel — semi-transparent so bg shows through ─── */
    .panel {
        position: relative;
        z-index: 10;
        width: 100%;
        max-width: 580px;
        margin: 20px;
        padding: 28px 44px 32px;
        display: flex;
        flex-direction: column;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        border: solid 1px #6594B1;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: #213C51;
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        margin-bottom: 10px;
        width: fit-content;
    }

    .back-link:hover {
        opacity: 0.7;
    }

    .logo {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .logo svg {
        width: 90px;
        height: 90px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px 20px;
        margin-bottom: 12px;
    }

    .col-full {
        grid-column: 1 / -1;
    }

    .field {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .field label {
        font-family: 'Sarabun', sans-serif;
        font-size: 14px;
        color: #213C51;
        font-weight: 500;
    }

    .input-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.85);
        border: 1.5px solid #d0d5e0;
        border-radius: 8px;
        padding: 0 12px;
        transition: border-color .2s, box-shadow .2s;
    }

    .input-wrap:focus-within {
        border-color: var(--btn);
        box-shadow: 0 0 0 3px rgba(107, 143, 191, .15);
    }

    .input-icon {
        color: #7a8499;
        flex-shrink: 0;
        width: 16px;
        height: 16px;
    }

    .input-wrap input,
    .input-wrap select {
        flex: 1;
        border: none;
        background: transparent;
        padding: 12px 0;
        font-family: 'Sarabun', sans-serif;
        font-size: 14px;
        color: #1a1a2e;
        outline: none;
        appearance: none;
        -webkit-appearance: none;
    }

    .input-wrap input::placeholder {
        color: #b0b6c4;
    }

    .input-wrap select {
        color: #1a1a2e;
        cursor: pointer;
    }

    .sel-wrap {
        position: relative;
    }

    .sel-wrap .input-wrap {
        padding-right: 32px;
    }

    .sel-wrap::after {
        content: '';
        position: absolute;
        right: 12px;
        top: 65%;
        transform: translateY(-50%);
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 6px solid #7a8499;
        pointer-events: none;
    }

    /* textarea address */
    .input-wrap.area {
        align-items: flex-start;
        padding: 10px 12px;
    }

    .input-wrap.area textarea {
        flex: 1;
        border: none;
        background: transparent;
        font-family: 'Sarabun', sans-serif;
        font-size: 14px;
        color: #1a1a2e;
        outline: none;
        resize: none;
        min-height: 64px;
    }

    .input-wrap.area textarea::placeholder {
        color: #b0b6c4;
    }

    .eye-btn {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        color: #7a8499;
        display: flex;
        align-items: center;
    }

    .eye-btn:hover {
        color: #333;
    }

    .links-row {
        display: flex;
        justify-content: center;
        margin-bottom: 12px;
    }

    .links-row a {
        font-family: 'Sarabun', sans-serif;
        font-size: 12px;
        color: #213C51;
        text-decoration: underline;
        text-underline-offset: 2px;
        opacity: 0.8;
    }

    .links-row a:hover {
        opacity: 1;
    }

    .btn-save {
        width: 100%;
        padding: 15px;
        background: var(--btn);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-family: 'Sarabun', sans-serif;
        font-size: 17px;
        font-weight: 600;
        cursor: pointer;
        letter-spacing: 0.04em;
        transition: background .2s, transform .1s;
    }

    .btn-save:hover {
        background: var(--btn-h);
    }

    .btn-save:active {
        transform: scale(.98);
    }
    </style>
</head>

<body>

    <!-- BG -->
    <div class="bg">
        <div class="bg-inner" id="bgInner"></div>
    </div>

    <!-- PANEL -->
    <div class="panel">
        <a href="javascript:history.back()" class="back-link">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="15 18 9 12 15 6" />
            </svg>
            Back
        </a>

        <div class="logo">
            <?php include 'logo.php' ?>
        </div>

        <form method="POST" action="">
            <div class="form-grid">
                <div class="field">
                    <label>ชื่อ</label>
                    <div class="input-wrap"><input style="color:gray" type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($first_name);?>"></div>
                </div>
                <div class="field">
                    <label>นามสกุล</label>
                    <div class="input-wrap"><input style="color:gray"  type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($last_name); ?>"></div>
                </div>
                <div class="field">
                    <label>เบอร์โทร</label>
                    <div class="input-wrap"><input style="color:gray" type="text" id="tel" name="tel" value="<?php echo htmlspecialchars($user['tel'] ?? ''); ?>"></div>
                </div>
                <div class="field">
                    <label>วันเกิด</label>
                    <div class="input-wrap"><input style="color:gray" type="date" id="birthday" name="birthday" value="<?php echo htmlspecialchars($user['birthday'] ?? ''); ?>"></div>
                </div>
                <div class="field sel-wrap">
                    <label for="job">อาชีพ</label>
                    <div class="input-wrap">
                        <select id="job" name="job">
                            <option value="Student" <?php echo ($user['job'] ?? '') === 'Student' ? 'selected' : ''; ?>>นักเรียน</option>
                            <option value="Designer" <?php echo ($user['job'] ?? '') === 'Designer' ? 'selected' : ''; ?>>นักออกแบบ</option>
                            <option value="Developer" <?php echo ($user['job'] ?? '') === 'Developer' ? 'selected' : ''; ?>>ผู้พัฒนา</option>
                            <option value="Programmer" <?php echo ($user['job'] ?? '') === 'Programmer' ? 'selected' : ''; ?>>โปรแกรมเมอร์</option>
                            <option value="Manager" <?php echo ($user['job'] ?? '') === 'Manager' ? 'selected' : ''; ?>>ผู้จัดการ</option>
                            <option value="Teacher" <?php echo ($user['job'] ?? '') === 'Teacher' ? 'selected' : ''; ?>>ครู/อาจารย์</option>
                            <option value="Engineer" <?php echo ($user['job'] ?? '') === 'Engineer' ? 'selected' : ''; ?>>วิศวกร</option>
                            <option value="Self-employed" <?php echo ($user['job'] ?? '') === 'Self-employed' ? 'selected' : ''; ?>>ฟรีแลนซ์</option>
                            <option value="Unemployed" <?php echo ($user['job'] ?? '') === 'Unemployed' ? 'selected' : ''; ?>>ว่างงาน</option>
                            <option value="Other" <?php echo ($user['job'] ?? '') === 'Other' ? 'selected' : ''; ?>>อื่นๆ</option>
                        </select>
                    </div>
                </div>
                <div class="field sel-wrap">
                    <label for="gender">เพศ</label>
                    <div class="input-wrap">
                        <select id="gender" name="gender">
                            <option value="male" <?php echo ($user['gender'] ?? '') === 'male' ? 'selected' : ''; ?>>ชาย</option>
                            <option value="female" <?php echo ($user['gender'] ?? '') === 'female' ? 'selected' : ''; ?>>หญิง</option>
                            <option value="other" <?php echo ($user['gender'] ?? '') === 'other' ? 'selected' : ''; ?>>อื่นๆ</option>
                        </select>
                    </div>
                </div>
                <div class="field col-full">
                    <label for="address">ที่อยู่</label>
                    <div class="input-wrap area">
                        <textarea style="color:gray" id="address" name="address"><?php echo htmlspecialchars($user['address'] ?? ''); ?></textarea>
                    </div>
                </div>
               
            </div>
        </form>

        <button class="btn-save">บันทึก</button>
    </div>

    <script>
    const wordSets = [
        [['HACKATHON', 'c1'],['PARTY', 'c2'],['EVENT', 'c1'],['COMMUNITY', 'c2'],['MEETING', 'c1'],['MIXER', 'c2'],['WORK', 'c1'],['BALL', 'c2']],
        [['CHARITY', 'c2'],['WORK', 'c1'],['MIXER', 'c2'],['PARTY', 'c1'],['EVENT', 'c2'],['HACKATHON', 'c1'],['COMMUNITY', 'c2'],['MEETING', 'c1']],
        [['COMMUNITY', 'c1'],['MEETING', 'c2'],['HACKATHON', 'c1'],['WORK', 'c2'],['PARTY', 'c1'],['CHARITY', 'c2'],['MIXER', 'c1'],['EVENT', 'c2']],
        [['EVENT', 'c2'],['MIXER', 'c1'],['PARTY', 'c2'],['CHARITY', 'c1'],['MEETING', 'c2'],['WORK', 'c1'],['BALL', 'c2'],['HACKATHON', 'c1']],
        [['PARTY', 'c1'],['COMMUNITY', 'c2'],['HACKATHON', 'c1'],['MEETING', 'c2'],['WORK', 'c1'],['EVENT', 'c2'],['MIXER', 'c1'],['CHARITY', 'c2']],
        [['MIXER', 'c2'],['EVENT', 'c1'],['CHARITY', 'c2'],['PARTY', 'c1'],['MEETING', 'c2'],['COMMUNITY', 'c1'],['WORK', 'c2'],['BALL', 'c1']],
        [['HACKATHON', 'c2'],['COMMUNITY', 'c1'],['WORK', 'c2'],['MIXER', 'c1'],['EVENT', 'c2'],['PARTY', 'c1'],['BALL', 'c1'],['MEETING', 'c2']],
        [['PARTY', 'c1'],['MEETING', 'c2'],['CHARITY', 'c1'],['HACKATHON', 'c2'],['MIXER', 'c1'],['WORK', 'c2'],['EVENT', 'c1'],['COMMUNITY', 'c2']],
        [['EVENT', 'c2'],['PARTY', 'c1'],['COMMUNITY', 'c2'],['WORK', 'c1'],['HACKATHON', 'c2'],['MEETING', 'c1'],['CHARITY', 'c2'],['MIXER', 'c1']],
        [['WORK', 'c1'],['MIXER', 'c2'],['PARTY', 'c1'],['COMMUNITY', 'c2'],['MEETING', 'c1'],['CHARITY', 'c2'],['BALL', 'c2'],['EVENT', 'c1']],
        [['BALL', 'c1'],['HACKATHON', 'c2'],['EVENT', 'c1'],['MIXER', 'c2'],['PARTY', 'c1'],['COMMUNITY', 'c2'],['WORK', 'c1'],['CHARITY', 'c2']],
        [['MEETING', 'c2'],['CHARITY', 'c1'],['BALL', 'c2'],['PARTY', 'c1'],['HACKATHON', 'c2'],['EVENT', 'c1'],['MIXER', 'c2'],['WORK', 'c1']],
        [['HACKATHON', 'c1'],['BALL', 'c2'],['COMMUNITY', 'c1'],['MEETING', 'c2'],['WORK', 'c1'],['PARTY', 'c2'],['EVENT', 'c1'],['MIXER', 'c2']],
        [['MIXER', 'c1'],['CHARITY', 'c2'],['PARTY', 'c1'],['BALL', 'c2'],['HACKATHON', 'c1'],['WORK', 'c2'],['COMMUNITY', 'c1'],['MEETING', 'c2']],
        [['EVENT', 'c2'],['MEETING', 'c1'],['MIXER', 'c2'],['CHARITY', 'c1'],['PARTY', 'c2'],['BALL', 'c1'],['HACKATHON', 'c2'],['WORK', 'c1']],
        [['COMMUNITY', 'c2'],['WORK', 'c1'],['PARTY', 'c2'],['EVENT', 'c1'],['MIXER', 'c2'],['MEETING', 'c1'],['CHARITY', 'c2'],['BALL', 'c1']],
        [['BALL', 'c1'],['PARTY', 'c2'],['HACKATHON', 'c1'],['COMMUNITY', 'c2'],['WORK', 'c1'],['MIXER', 'c2'],['EVENT', 'c1'],['MEETING', 'c2']],
        [['CHARITY', 'c1'],['EVENT', 'c2'],['MEETING', 'c1'],['BALL', 'c2'],['PARTY', 'c1'],['HACKATHON', 'c2'],['WORK', 'c1'],['MIXER', 'c2']],
        [['WORK', 'c2'],['COMMUNITY', 'c1'],['BALL', 'c2'],['MIXER', 'c1'],['CHARITY', 'c2'],['EVENT', 'c1'],['PARTY', 'c2'],['HACKATHON', 'c1']],
        [['PARTY', 'c1'],['HACKATHON', 'c2'],['MEETING', 'c1'],['WORK', 'c2'],['BALL', 'c1'],['COMMUNITY', 'c2'],['MIXER', 'c1'],['CHARITY', 'c2']],
        [['MIXER', 'c2'],['BALL', 'c1'],['EVENT', 'c2'],['PARTY', 'c1'],['COMMUNITY', 'c2'],['HACKATHON', 'c1'],['MEETING', 'c2'],['WORK', 'c1']],
        [['HACKATHON', 'c1'],['CHARITY', 'c2'],['WORK', 'c1'],['MEETING', 'c2'],['MIXER', 'c1'],['BALL', 'c2'],['PARTY', 'c1'],['EVENT', 'c2']],
        [['EVENT', 'c1'],['COMMUNITY', 'c2'],['PARTY', 'c1'],['HACKATHON', 'c2'],['CHARITY', 'c1'],['MIXER', 'c2'],['BALL', 'c1'],['WORK', 'c2']],
        [['WORK', 'c2'],['MEETING', 'c1'],['BALL', 'c2'],['EVENT', 'c1'],['COMMUNITY', 'c2'],['PARTY', 'c1'],['HACKATHON', 'c2'],['MIXER', 'c1']],
        [['BALL', 'c2'],['MIXER', 'c1'],['HACKATHON', 'c2'],['CHARITY', 'c1'],['WORK', 'c2'],['EVENT', 'c1'],['MEETING', 'c2'],['COMMUNITY', 'c1']],
    ];

    const inner = document.getElementById('bgInner');
    wordSets.forEach(pat => {
        const row = document.createElement('div');
        row.className = 'bg-row';
        let html = '';
        for (let r = 0; r < 4; r++) {
            pat.forEach(([word, cls]) => {
                html +=
                    `<span class="word w-${cls}"><span class="fill">${word[0]}</span><span class="outline">${word.slice(1)}</span></span>`;
            });
        }
        row.innerHTML = html;
        inner.appendChild(row);
    });
    </script>
</body>

</html>