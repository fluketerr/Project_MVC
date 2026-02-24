<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@900&family=Sarabun:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --c1: #213C51;
    --c2: #DDAED3;
    --btn: #6b8fbf;
    --btn-h: #4e78ab;
  }

  body {
    font-family: 'Sarabun', sans-serif;
    min-height: 100vh;
    background: linear-gradient(to bottom, #EEEEEE, #888888);
    overflow: hidden;
    position: relative;
  }

  /* ─── Background text ─── */
  .bg {
    position: fixed;
    inset: 0;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    pointer-events: none;
    z-index: 0;
  }

  .bg-row {
    display: flex;
    align-items: center;
    white-space: nowrap;
    font-family: 'Inter', 'Arial Black', sans-serif;
    font-weight: 900;
    font-size: 11vw;
    line-height: 1.0;
    letter-spacing: -0.01em;
    text-transform: uppercase;
    flex-shrink: 0;
  }

  .bg-row:nth-child(odd)  { animation: slideL 26s linear infinite; }
  .bg-row:nth-child(even) { animation: slideR 30s linear infinite; }
  .bg-row:nth-child(3n+1) { animation-duration: 22s; }
  .bg-row:nth-child(3n+2) { animation-duration: 30s; }
  .bg-row:nth-child(5n)   { animation-duration: 18s; }

  @keyframes slideL { from { transform: translateX(0) }    to { transform: translateX(-50%) } }
  @keyframes slideR { from { transform: translateX(-50%) } to { transform: translateX(0) } }

  .word { display: inline-flex; align-items: baseline; margin-right: 0.28em; }

  .w-c1 .fill    { color: #213C51; }
  .w-c2 .fill    { color: #DDAED3; }
  .w-c1 .outline { -webkit-text-stroke: 2px #213C51; -webkit-text-fill-color: transparent; }
  .w-c2 .outline { -webkit-text-stroke: 2px #DDAED3; -webkit-text-fill-color: transparent; }

  /* ─── Login panel —─── */
  .panel {
    background-color: white;
    position: absolute;
    z-index: 10;
    width: 50%;
    max-width: 440px;
    margin: 150px 50vw 100px 35vw;
    padding: 32px 24px 40px;
    display: flex;
    flex-direction: column;
    min-height: 50vh;
    animation: fadeUp .4s ease both;
    border-radius: 20px;
  }

  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(16px) }
    to   { opacity: 1; transform: translateY(0) }
  }

  /* Back */
  .back-link {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    color: #213C51;
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    font-weight: 700;
    text-decoration: none;
    margin-bottom: 16px;
    width: fit-content;
  }
  .back-link:hover { opacity: 0.7; }

  /* Logo */
  .logo {
    display: flex;
    justify-content: center;
    margin-bottom: 52px;
  }
  .logo svg { width: 110px; height: 110px; }

  /* Inputs */
  .input-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 14px;
  }

  .input-wrap {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,255,255,0.92);
    border: 1.5px solid rgba(0,0,0,0.1);
    border-radius: 10px;
    padding: 0 16px;
    transition: border-color .2s, box-shadow .2s;
  }
  .input-wrap:focus-within {
    border-color: var(--btn);
    box-shadow: 0 0 0 3px rgba(107,143,191,.2);
  }

  .input-icon { color: #7a8499; flex-shrink: 0; width: 18px; height: 18px; }

  .input-wrap input {
    flex: 1;
    border: none;
    background: transparent;
    padding: 16px 0;
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    color: #1a1a2e;
    outline: none;
  }
  .input-wrap input::placeholder { color: #aab0be; }

  .eye-btn {
    background: none; border: none; cursor: pointer;
    padding: 0; color: #7a8499; display: flex; align-items: center;
  }
  .eye-btn:hover { color: #333; }

  /* Links */
  .links-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 28px;
    padding: 0 2px;
  }
  .links-row a {
    font-family: 'Inter', sans-serif;
    font-size: 12px;
    color: #213C51;
    text-decoration: underline;
    text-underline-offset: 2px;
    opacity: 0.8;
  }
  .links-row a:hover { opacity: 1; }

  /* Button */
  .btn-login {
    width: 100%;
    padding: 16px;
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
  .btn-login:hover  { background: var(--btn-h); }
  .btn-login:active { transform: scale(.98); }
</style>
</head>
<body>

<div class="bg" id="bg"></div>

<div class="panel">
  <a href="/home" class="back-link">
    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
      <polyline points="15 18 9 12 15 6"/>
    </svg>
    Back
  </a>

  <div class="logo">
    <?php include 'logo.php'; ?>
  </div>

  <div class="input-group">
    <div class="input-wrap">
      <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
        <circle cx="12" cy="7" r="4"/>
      </svg>
      <input type="text" placeholder="Username" autocomplete="username">
    </div>
    <div class="input-wrap">
      <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="11" width="18" height="11" rx="2"/>
        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
      </svg>
      <input type="password" id="pwInput" placeholder="Password" autocomplete="current-password">
      <button class="eye-btn" onclick="togglePw()" type="button">
        <svg id="eyeIco" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20">
          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
          <circle cx="12" cy="12" r="3"/>
        </svg>
      </button>
    </div>
  </div>

  <div class="links-row">
    <a href="/user-chgpwd">ลืมรหัสผ่าน?</a>
    <a href="/register_user">ยังไม่มีบัญชี?</a>
  </div>

  <button class="btn-login">เข้าสู่ระบบ</button>
</div>

<script>
  const rows = [
    [['HACKATHON','c1'],['PARTY','c2'],['EVENT','c1'],['COMMUNITY','c2'],['MEETING','c1'],['MIXER','c2']],
    [['CHARITY','c2'],['WORK','c1'],['MIXER','c2'],['PARTY','c1'],['EVENT','c2'],['HACKATHON','c1']],
    [['COMMUNITY','c1'],['MEETING','c2'],['HACKATHON','c1'],['WORK','c2'],['PARTY','c1'],['CHARITY','c2']],
    [['EVENT','c2'],['MIXER','c1'],['PARTY','c2'],['CHARITY','c1'],['MEETING','c2'],['WORK','c1']],
    [['PARTY','c1'],['COMMUNITY','c2'],['HACKATHON','c1'],['MEETING','c2'],['WORK','c1'],['EVENT','c2']],
    [['MIXER','c2'],['EVENT','c1'],['CHARITY','c2'],['PARTY','c1'],['MEETING','c2'],['COMMUNITY','c1']],
    [['HACKATHON','c2'],['COMMUNITY','c1'],['WORK','c2'],['MIXER','c1'],['EVENT','c2'],['PARTY','c1']],
    [['PARTY','c1'],['MEETING','c2'],['CHARITY','c1'],['HACKATHON','c2'],['MIXER','c1'],['WORK','c2']],
    [['EVENT','c2'],['PARTY','c1'],['COMMUNITY','c2'],['WORK','c1'],['HACKATHON','c2'],['MEETING','c1']],
    [['WORK','c1'],['MIXER','c2'],['PARTY','c1'],['COMMUNITY','c2'],['MEETING','c1'],['CHARITY','c2']],
  ];

  const bg = document.getElementById('bg');
  rows.forEach(pat => {
    const row = document.createElement('div');
    row.className = 'bg-row';
    let html = '';
    for (let r = 0; r < 2; r++) {
      pat.forEach(([word, cls]) => {
        html += `<span class="word w-${cls}"><span class="fill">${word[0]}</span><span class="outline">${word.slice(1)}</span></span>`;
      });
    }
    row.innerHTML = html;
    bg.appendChild(row);
  });

  function togglePw() {
    const inp = document.getElementById('pwInput');
    const ico = document.getElementById('eyeIco');
    if (inp.type === 'password') {
      inp.type = 'text';
      ico.innerHTML = `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>`;
    } else {
      inp.type = 'password';
      ico.innerHTML = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
    }
  }
</script>
</body>
</html>