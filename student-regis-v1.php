<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Registration</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
<style>
:root {
  --navy: #1a3a5c;
  --navy2: #2a5298;
  --gold: #e8a020;
  --gold-soft: #fdf3e3;
  --bg: #eef1f8;
  --surface: #ffffff;
  --border: #d0d8e8;
  --text: #1a2540;
  --muted: #6b7a99;
  --danger: #c0392b;
  --success-bg: #e6f4ee;
  --success: #1a6e4a;
  --radius: 14px;
  --radius-sm: 8px;
  --shadow: 0 4px 28px rgba(26,58,92,0.09);
}
*,*::before,*::after { box-sizing:border-box; margin:0; padding:0; }
body { font-family:'DM Sans',sans-serif; background:var(--bg); color:var(--text); min-height:100vh; }

/* ── Header ── */
.hdr { background:var(--navy); padding:20px 40px; display:flex; align-items:center; justify-content:space-between; }
.hdr-logo { display:flex; align-items:center; gap:12px; }
.hdr-icon { width:40px; height:40px; background:var(--gold); border-radius:9px; display:flex; align-items:center; justify-content:center; font-size:20px; flex-shrink:0; }
.hdr-sub { color:rgba(255,255,255,.55); font-size:12px; line-height:1.5; }
.hdr-sub strong { display:block; color:#fff; font-size:14px; font-weight:600; }
.hdr-title { font-family:'Playfair Display',serif; color:#fff; font-size:22px; text-align:right; }
.hdr-title small { display:block; color:var(--gold); font-family:'DM Sans',sans-serif; font-size:10px; font-weight:600; letter-spacing:.12em; text-transform:uppercase; margin-bottom:3px; }

/* ── Progress Bar ── */
.progress-wrap { background:#fff; border-bottom:1px solid var(--border); padding:0 40px; position:sticky; top:0; z-index:100; }
.progress-inner { max-width:820px; margin:0 auto; padding:14px 0; }
.progress-steps { display:flex; align-items:center; gap:0; }
.p-step { display:flex; flex-direction:column; align-items:center; position:relative; flex:1; }
.p-step:not(:last-child)::after { content:''; position:absolute; top:14px; left:50%; width:100%; height:2px; background:var(--border); z-index:0; transition:background .4s; }
.p-step.done:not(:last-child)::after { background:var(--navy); }
.p-step.active:not(:last-child)::after { background:var(--border); }
.p-dot { width:28px; height:28px; border-radius:50%; border:2px solid var(--border); background:#fff; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:600; color:var(--muted); z-index:1; transition:all .3s; position:relative; }
.p-step.done .p-dot { background:var(--navy); border-color:var(--navy); color:#fff; }
.p-step.active .p-dot { background:var(--gold); border-color:var(--gold); color:#fff; box-shadow:0 0 0 4px rgba(232,160,32,.2); }
.p-label { font-size:10px; color:var(--muted); margin-top:5px; letter-spacing:.03em; text-align:center; font-weight:500; white-space:nowrap; }
.p-step.active .p-label { color:var(--navy); font-weight:600; }
.p-step.done .p-label { color:var(--navy); }

/* ── Page wrapper ── */
.page { display:none; }
.page.active { display:block; animation:fadeUp .35s ease both; }
@keyframes fadeUp { from{opacity:0;transform:translateY(18px)} to{opacity:1;transform:none} }
.container { max-width:820px; margin:0 auto; padding:32px 20px 60px; }

/* ── Landing ── */
.landing { text-align:center; padding:60px 20px; }
.landing-badge { display:inline-block; background:var(--gold-soft); color:var(--gold); font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; padding:5px 14px; border-radius:99px; margin-bottom:20px; border:1px solid #f5d78e; }
.landing h1 { font-family:'Playfair Display',serif; font-size:42px; color:var(--navy); line-height:1.15; margin-bottom:14px; }
.landing p { color:var(--muted); font-size:16px; max-width:480px; margin:0 auto 36px; line-height:1.7; }
.landing-card { background:var(--surface); border-radius:var(--radius); border:1px solid var(--border); padding:28px 32px; max-width:540px; margin:0 auto 32px; text-align:left; box-shadow:var(--shadow); }
.landing-card h3 { font-size:13px; font-weight:700; color:var(--navy); text-transform:uppercase; letter-spacing:.08em; margin-bottom:14px; }
.step-list { list-style:none; display:flex; flex-direction:column; gap:10px; }
.step-list li { display:flex; align-items:center; gap:12px; font-size:14px; color:var(--text); }
.step-num { width:26px; height:26px; border-radius:50%; background:var(--navy); color:#fff; font-size:11px; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.step-num.gold { background:var(--gold); }

/* ── Section card ── */
.card { background:var(--surface); border-radius:var(--radius); border:1px solid var(--border); box-shadow:var(--shadow); margin-bottom:24px; overflow:hidden; }
.card-head { background:var(--navy); padding:14px 24px; display:flex; align-items:center; gap:10px; }
.card-head-bar { width:16px; height:3px; background:var(--gold); border-radius:2px; flex-shrink:0; }
.card-head-title { color:#fff; font-size:11px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; }
.card-head-sub { color:rgba(255,255,255,.5); font-size:11px; margin-left:auto; }
.card-body { padding:24px; }

/* ── Form elements ── */
.frow { display:flex; gap:16px; margin-bottom:18px; flex-wrap:wrap; }
.fgroup { flex:1; min-width:140px; display:flex; flex-direction:column; gap:5px; }
.fgroup.full { flex-basis:100%; }
.flabel { font-size:11px; font-weight:600; color:var(--muted); text-transform:uppercase; letter-spacing:.07em; }
.flabel .req { color:var(--danger); margin-left:2px; }
input[type=text], input[type=number], select, textarea {
  border:1.5px solid var(--border); border-radius:var(--radius-sm);
  padding:9px 12px; font-family:'DM Sans',sans-serif; font-size:14px;
  color:var(--text); background:#fafbfd; outline:none; width:100%;
  transition:border-color .18s, box-shadow .18s;
}
input:focus, select:focus, textarea:focus { border-color:var(--navy2); background:#fff; box-shadow:0 0 0 3px rgba(42,82,152,.1); }
input::placeholder { color:#bdc5d4; }
select { cursor:pointer; }

/* Date row */
.date-row { display:flex; gap:10px; flex-wrap:wrap; }
.date-row .fgroup { min-width:100px; }
.month-wrap { position:relative; }
.month-input { cursor:text; }
.month-dropdown { position:absolute; top:calc(100% + 4px); left:0; right:0; background:#fff; border:1.5px solid var(--navy2); border-radius:var(--radius-sm); z-index:200; max-height:180px; overflow-y:auto; box-shadow:0 8px 24px rgba(0,0,0,.1); display:none; }
.month-dropdown.open { display:block; }
.month-opt { padding:8px 12px; font-size:14px; cursor:pointer; color:var(--text); }
.month-opt:hover, .month-opt.highlighted { background:var(--bg); }

/* Radio / Check styled */
.choice-group { display:flex; gap:12px; flex-wrap:wrap; }
.choice-btn { display:flex; align-items:center; gap:8px; padding:9px 16px; border:1.5px solid var(--border); border-radius:var(--radius-sm); cursor:pointer; font-size:13px; font-weight:500; color:var(--muted); transition:all .18s; user-select:none; background:#fafbfd; }
.choice-btn:hover { border-color:var(--navy2); color:var(--navy); }
.choice-btn.selected { border-color:var(--navy); background:rgba(26,58,92,.06); color:var(--navy); font-weight:600; }
.choice-btn.selected .choice-dot { background:var(--navy); }
.choice-dot { width:14px; height:14px; border-radius:50%; border:2px solid var(--border); transition:all .18s; flex-shrink:0; }
.choice-btn.selected .choice-dot { border-color:var(--navy); background:var(--navy); box-shadow:inset 0 0 0 2px #fff; }
/* Checkbox version */
.choice-check { width:14px; height:14px; border-radius:3px; border:2px solid var(--border); transition:all .18s; flex-shrink:0; display:flex; align-items:center; justify-content:center; }
.choice-btn.selected .choice-check { border-color:var(--navy); background:var(--navy); }
.choice-btn.selected .choice-check::after { content:'✓'; font-size:9px; color:#fff; font-weight:700; }

/* Conditional section */
.cond-block { display:none; padding:16px; background:#f5f7fb; border-radius:var(--radius-sm); border:1px dashed var(--border); margin-top:10px; }
.cond-block.visible { display:block; animation:fadeUp .25s ease both; }
.cond-note { font-size:12px; color:var(--success); background:var(--success-bg); border-radius:6px; padding:8px 12px; margin-bottom:14px; border-left:3px solid var(--success); font-weight:500; }

/* Buttons */
.btn-primary { display:inline-flex; align-items:center; gap:8px; padding:13px 28px; background:var(--navy); color:#fff; border:none; border-radius:var(--radius-sm); font-family:'DM Sans',sans-serif; font-size:14px; font-weight:600; cursor:pointer; transition:background .2s, transform .15s, box-shadow .2s; box-shadow:0 4px 14px rgba(26,58,92,.25); }
.btn-primary:hover { background:var(--navy2); transform:translateY(-1px); }
.btn-primary:active { transform:none; }
.btn-secondary { display:inline-flex; align-items:center; gap:8px; padding:12px 24px; background:#fff; color:var(--navy); border:1.5px solid var(--border); border-radius:var(--radius-sm); font-family:'DM Sans',sans-serif; font-size:14px; font-weight:500; cursor:pointer; transition:all .18s; }
.btn-secondary:hover { border-color:var(--navy); background:rgba(26,58,92,.04); }
.btn-gold { background:var(--gold); box-shadow:0 4px 14px rgba(232,160,32,.35); }
.btn-gold:hover { background:#d09010; }
.btn-danger { background:#c0392b; box-shadow:0 4px 14px rgba(192,57,43,.25); }
.btn-danger:hover { background:#a93226; }
.nav-row { display:flex; justify-content:space-between; align-items:center; margin-top:10px; }

/* Summary */
.summary-warn { background:#fff8e6; border:1.5px solid #f5c84a; border-radius:var(--radius-sm); padding:14px 18px; margin-bottom:24px; display:flex; gap:12px; align-items:flex-start; }
.warn-icon { font-size:20px; flex-shrink:0; margin-top:1px; }
.warn-text { font-size:13px; line-height:1.6; color:#7a5c00; }
.warn-text strong { display:block; margin-bottom:3px; color:#5a4000; font-size:14px; }
.sum-section { margin-bottom:18px; }
.sum-section-title { font-size:10px; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:.1em; padding-bottom:8px; border-bottom:1px solid var(--border); margin-bottom:12px; }
.sum-grid { display:grid; grid-template-columns:1fr 1fr; gap:8px 20px; }
.sum-item { display:flex; flex-direction:column; gap:3px; }
.sum-key { font-size:11px; color:var(--muted); font-weight:500; }
.sum-val { font-size:14px; font-weight:500; color:var(--text); }
.sum-val.em { color:var(--navy); font-weight:700; }

/* Receipt */
.receipt { max-width:500px; margin:0 auto; }
.receipt-top { background:var(--navy); border-radius:var(--radius) var(--radius) 0 0; padding:28px 32px; text-align:center; }
.receipt-top h2 { font-family:'Playfair Display',serif; color:#fff; font-size:24px; margin-bottom:6px; }
.receipt-top p { color:rgba(255,255,255,.6); font-size:13px; }
.receipt-badge { display:inline-block; background:var(--gold); color:#fff; font-size:11px; font-weight:700; padding:5px 16px; border-radius:99px; margin-bottom:16px; letter-spacing:.05em; }
.receipt-body { background:#fff; border:1px solid var(--border); border-top:none; border-radius:0 0 var(--radius) var(--radius); padding:28px 32px; }
.receipt-name { font-family:'Playfair Display',serif; font-size:26px; color:var(--navy); text-align:center; margin-bottom:4px; }
.receipt-date { text-align:center; color:var(--muted); font-size:13px; margin-bottom:24px; }
.receipt-divider { border:none; border-top:1px dashed var(--border); margin:18px 0; }
.receipt-row { display:flex; justify-content:space-between; font-size:13px; padding:5px 0; }
.receipt-row span:first-child { color:var(--muted); }
.receipt-row span:last-child { font-weight:500; color:var(--text); }
.receipt-ref { text-align:center; margin-top:22px; }
.receipt-ref .ref-num { font-size:18px; font-weight:700; color:var(--navy); letter-spacing:.08em; font-family:'DM Sans',sans-serif; }
.receipt-ref .ref-label { font-size:11px; color:var(--muted); margin-top:2px; }
.confetti { font-size:36px; text-align:center; margin-bottom:12px; }

/* Validation */
input.invalid, select.invalid { border-color:var(--danger); background:#fff8f8; }
.err-msg { font-size:11px; color:var(--danger); margin-top:3px; display:none; }
.err-msg.show { display:block; }

@media(max-width:600px) {
  .hdr { flex-direction:column; align-items:flex-start; padding:16px 20px; gap:10px; }
  .hdr-title { text-align:left; font-size:18px; }
  .progress-wrap { padding:0 16px; }
  .p-label { font-size:9px; }
  .landing h1 { font-size:28px; }
  .container { padding:20px 14px 50px; }
  .frow { flex-direction:column; }
  .sum-grid { grid-template-columns:1fr; }
  .nav-row { flex-direction:column-reverse; gap:10px; }
  .nav-row .btn-primary,.nav-row .btn-secondary { width:100%; justify-content:center; }
  .receipt-body,.receipt-top { padding:20px; }
}
</style>
</head>
<body>

<header class="hdr">
  <div class="hdr-logo">
    <div class="hdr-icon">🎓</div>
    <div class="hdr-sub"><strong>Academic Registrar</strong>Student Enrollment System</div>
  </div>
  <div class="hdr-title"><small>New Student</small>Registration Form</div>
</header>

<!-- Progress (hidden on landing) -->
<div class="progress-wrap" id="progressBar" style="display:none">
  <div class="progress-inner">
    <div class="progress-steps" id="progressSteps"></div>
  </div>
</div>

<!-- ═══════════════ LANDING ═══════════════ -->
<div class="page active" id="page-landing">
  <div class="container">
    <div class="landing">
      <div class="landing-badge">Academic Year Enrollment</div>
      <h1>Student Registration</h1>
      <p>Complete your enrollment in a few easy steps. The form will guide you through each section and only show fields relevant to you.</p>
      <div class="landing-card">
        <h3>What to expect</h3>
        <ul class="step-list">
          <li><div class="step-num">1</div> Student Information &amp; Personal Details</li>
          <li><div class="step-num">2</div> Previous School Information</li>
          <li><div class="step-num">3</div> Health Information</li>
          <li><div class="step-num">4</div> Citizenship &amp; Contact Information</li>
          <li><div class="step-num gold">✓</div> Review &amp; Submit</li>
        </ul>
      </div>
      <button class="btn-primary btn-gold" onclick="startForm()">Begin Registration →</button>
    </div>
  </div>
</div>

<!-- ═══════════════ STEP 1: Student Info ═══════════════ -->
<div class="page" id="page-1">
  <div class="container">

    <div class="card">
      <div class="card-head"><div class="card-head-bar"></div><div class="card-head-title">Full Legal Name</div></div>
      <div class="card-body">
        <div class="frow">
          <div class="fgroup">
            <label class="flabel">Last Name <span class="req">*</span></label>
            <input type="text" id="last_name" placeholder="e.g. Dela Cruz">
            <div class="err-msg" id="err_last_name">This field is required.</div>
          </div>
          <div class="fgroup">
            <label class="flabel">First Name <span class="req">*</span></label>
            <input type="text" id="first_name" placeholder="e.g. Juan">
            <div class="err-msg" id="err_first_name">This field is required.</div>
          </div>
          <div class="fgroup">
            <label class="flabel">Middle Name</label>
            <input type="text" id="middle_name" placeholder="e.g. Santos (optional)">
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-head"><div class="card-head-bar"></div><div class="card-head-title">Preferred Name</div><div class="card-head-sub">If different from legal name</div></div>
      <div class="card-body">
        <div class="frow" style="margin-bottom:10px">
          <div class="fgroup full">
            <label class="flabel">Does the student use a preferred/nickname?</label>
            <div class="choice-group" style="margin-top:6px">
              <div class="choice-btn" onclick="toggleCond(this,'pref-name-block','radio')" data-val="yes"><div class="choice-dot"></div>Yes</div>
              <div class="choice-btn selected" onclick="toggleCond(this,'pref-name-block','radio')" data-val="no"><div class="choice-dot"></div>No</div>
            </div>
          </div>
        </div>
        <div class="cond-block" id="pref-name-block">
          <div class="frow">
            <div class="fgroup"><label class="flabel">Preferred Last Name</label><input type="text" id="pref_last_name" placeholder="Last Name"></div>
            <div class="fgroup"><label class="flabel">Preferred First Name</label><input type="text" id="pref_first_name" placeholder="First Name"></div>
            <div class="fgroup"><label class="flabel">Preferred Middle Name</label><input type="text" id="pref_middle_name" placeholder="Middle Name"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-head"><div class="card-head-bar"></div><div class="card-head-title">Personal Details</div></div>
      <div class="card-body">
        <div class="frow">
          <div class="fgroup">
            <label class="flabel">Gender <span class="req">*</span></label>
            <div class="choice-group" style="margin-top:6px" id="gender-group">
              <div class="choice-btn" onclick="selectRadio(this,'gender-group','gender_val')" data-val="Male"><div class="choice-dot"></div>Male</div>
              <div class="choice-btn" onclick="selectRadio(this,'gender-group','gender_val')" data-val="Female"><div class="choice-dot"></div>Female</div>
              <div class="choice-btn" onclick="selectRadio(this,'gender-group','gender_val')" data-val="Other"><div class="choice-dot"></div>Other / Prefer not to say</div>
            </div>
            <input type="hidden" id="gender_val">
            <div class="err-msg" id="err_gender">Please select a gender.</div>
          </div>
        </div>
        <div class="frow" style="margin-top:8px">
          <div class="fgroup full">
            <label class="flabel">Date of Birth <span class="req">*</span></label>
            <div class="date-row" style="margin-top:6px">
              <div class="fgroup month-wrap">
                <input type="text" class="month-input" id="birth_month" placeholder="Month" autocomplete="off" oninput="filterMonths(this,'bm-drop')" onfocus="openDropdown('bm-drop')" onblur="closeDropdown('bm-drop',300)">
                <div class="month-dropdown" id="bm-drop"></div>
              </div>
              <div class="fgroup" style="max-width:80px"><input type="number" id="birth_day" placeholder="Day" min="1" max="31"></div>
              <div class="fgroup" style="max-width:100px"><input type="number" id="birth_year" placeholder="Year" min="1980" max="2020"></div>
            </div>
            <div class="err-msg" id="err_birth">Please complete the date of birth.</div>
          </div>
        </div>
      </div>
    </div>

    <div class="nav-row">
      <div></div>
      <button class="btn-primary" onclick="goNext(1)">Continue → Previous School</button>
    </div>
  </div>
</div>

<!-- ═══════════════ STEP 2: Previous School ═══════════════ -->
<div class="page" id="page-2">
  <div class="container">

    <div class="card">
      <div class="card-head"><div class="card-head-bar"></div><div class="card-head-title">Transfer Status</div></div>
      <div class="card-body">
        <div class="fgroup full">
          <label class="flabel">Is the student a transferee from another school?</label>
          <div class="choice-group" style="margin-top:8px">
            <div class="choice-btn" onclick="toggleCond(this,'transfer-block','radio')" data-val="yes"><div class="choice-dot"></div>Yes, I am a transferee</div>
            <div class="choice-btn selected" onclick="toggleCond(this,'transfer-block','radio')" data-val="no"><div class="choice-dot"></div>No, first-time enrollee</div>
          </div>
          <input type="hidden" id="is_transferee" value="no">
        </div>
        <div class="cond-block" id="transfer-block">
          <div class="cond-note">Please fill in your previous school details below.</div>
          <div class="frow">
            <div class="fgroup">
              <label class="flabel">Previous School Board / Municipality</label>
              <input type="text" id="prev_school_board" placeholder="e.g. Department of Education - NCR">
            </div>
            <div class="fgroup">
              <label class="flabel">Last Date Attended</label>
              <div class="date-row" style="margin-top:4px">
                <div class="fgroup month-wrap">
                  <input type="text" class="month-input" id="lda_month" placeholder="Month" autocomplete="off" oninput="filterMonths(this,'ldam-drop')" onfocus="openDropdown('ldam-drop')" onblur="closeDropdown('ldam-drop',300)">
                  <div class="month-dropdown" id="ldam-drop"></div>
                </div>
                <div class="fgroup" style="max-width:70px"><input type="number" id="lda_day" placeholder="Day" min="1" max="31"></div>
                <div class="fgroup" style="max-width:90px"><input type="number" id="lda_year" placeholder="Year" min="2000" max="2025"></div>
              </div>
            </div>
          </div>
          <div class="frow">
            <div class="fgroup">
              <label class="flabel">Name of Previous School</label>
              <input type="text" id="prev_school_name" placeholder="Full school name">
            </div>
            <div class="fgroup" style="max-width:160px">
              <label class="flabel">Grade at Previous School</label>
              <input type="number" id="grade_prev_school" placeholder="e.g. 10" min="1" max="12">
            </div>
          </div>
          <div class="frow">
            <div class="fgroup">
              <label class="flabel">Language of Instruction</label>
              <div class="choice-group" style="margin-top:6px" id="lang-group">
                <div class="choice-btn" onclick="toggleCheck(this)" data-val="English"><div class="choice-check"></div>English</div>
                <div class="choice-btn" onclick="toggleCheck(this)" data-val="Filipino"><div class="choice-check"></div>Filipino</div>
                <div class="choice-btn" onclick="toggleCheck(this)" data-val="French"><div class="choice-check"></div>French</div>
                <div class="choice-btn" onclick="toggleCheck(this)" data-val="Other"><div class="choice-check"></div>Other</div>
              </div>
            </div>
          </div>
          <div class="frow">
            <div class="fgroup full">
              <label class="flabel">Reason for Transfer</label>
              <select id="reason_transfer">
                <option value="">Select a reason…</option>
                <option>Change of residence / relocation</option>
                <option>Better academic programs</option>
                <option>Financial reasons</option>
                <option>Family decision</option>
                <option>Academic dissatisfaction</option>
                <option>Bullying or safety concerns</option>
                <option>Health-related reasons</option>
                <option>Other</option>
              </select>
            </div>
          </div>
          <div class="frow" id="reason-other-row" style="display:none">
            <div class="fgroup full">
              <label class="flabel">Please specify</label>
              <input type="text" id="reason_other" placeholder="Describe the reason for transfer…">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="nav-row">
      <button class="btn-secondary" onclick="goPrev(2)">← Back</button>
      <button class="btn-primary" onclick="goNext(2)">Continue → Health Info</button>
    </div>
  </div>
</div>

<!-- ═══════════════ STEP 3: Health ═══════════════ -->
<div class="page" id="page-3">
  <div class="container">

    <div class="card">
      <div class="card-head"><div class="card-head-bar"></div><div class="card-head-title">Health Information</div></div>
      <div class="card-body">
        <div class="fgroup full" style="margin-bottom:16px">
          <label class="flabel">Does the student have any current or past medical conditions?</label>
          <div class="choice-group" style="margin-top:8px">
            <div class="choice-btn" onclick="toggleCond(this,'health-block','radio')" data-val="yes"><div class="choice-dot"></div>Yes</div>
            <div class="choice-btn selected" onclick="toggleCond(this,'health-block','radio')" data-val="no"><div class="choice-dot"></div>No / None known</div>
          </div>
          <input type="hidden" id="has_medical" value="no">
        </div>
        <div class="cond-block" id="health-block">
          <div class="cond-note">Please provide the medical details below to ensure proper support for the student.</div>
          <div class="frow">
            <div class="fgroup full">
              <label class="flabel">Medical Conditions / Diagnoses</label>
              <input type="text" id="medical_conditions" placeholder="e.g. Asthma, Diabetes, ADHD…">
            </div>
          </div>
          <div class="frow">
            <div class="fgroup full">
              <label class="flabel">Allergies (if any)</label>
              <input type="text" id="allergies" placeholder="e.g. Penicillin, Peanuts, Latex…">
            </div>
          </div>
          <div class="frow">
            <div class="fgroup full">
              <label class="flabel">Does the student take regular medication?</label>
              <div class="choice-group" style="margin-top:6px">
                <div class="choice-btn" onclick="toggleCond(this,'meds-block','radio')" data-val="yes"><div class="choice-dot"></div>Yes</div>
                <div class="choice-btn selected" onclick="toggleCond(this,'meds-block','radio')" data-val="no"><div class="choice-dot"></div>No</div>
              </div>
            </div>
          </div>
          <div class="cond-block" id="meds-block">
            <div class="frow">
              <div class="fgroup full">
                <label class="flabel">Medication(s) and Dosage</label>
                <input type="text" id="medications" placeholder="e.g. Salbutamol 100mcg inhaler as needed">
              </div>
            </div>
          </div>
          <div class="frow">
            <div class="fgroup full">
              <label class="flabel">Emergency Medical Notes / Special Instructions</label>
              <textarea id="med_notes" rows="3" placeholder="Any special instructions the school nurse should know…" style="resize:vertical"></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="nav-row">
      <button class="btn-secondary" onclick="goPrev(3)">← Back</button>
      <button class="btn-primary" onclick="goNext(3)">Continue → Citizenship</button>
    </div>
  </div>
</div>

<!-- ═══════════════ STEP 4: Citizenship ═══════════════ -->
<div class="page" id="page-4">
  <div class="container">

    <div class="card">
      <div class="card-head"><div class="card-head-bar"></div><div class="card-head-title">Citizenship &amp; Origin</div></div>
      <div class="card-body">
        <div class="frow">
          <div class="fgroup">
            <label class="flabel">Country of Birth <span class="req">*</span></label>
            <input type="text" id="birth_country" placeholder="e.g. Philippines">
            <div class="err-msg" id="err_birth_country">This field is required.</div>
          </div>
          <div class="fgroup">
            <label class="flabel">Country of Citizenship <span class="req">*</span></label>
            <input type="text" id="citizenship" placeholder="e.g. Filipino">
            <div class="err-msg" id="err_citizenship">This field is required.</div>
          </div>
        </div>
        <div class="frow">
          <div class="fgroup full">
            <label class="flabel">Is the student an international / foreign national student?</label>
            <div class="choice-group" style="margin-top:8px">
              <div class="choice-btn" onclick="toggleCond(this,'intl-block','radio')" data-val="yes"><div class="choice-dot"></div>Yes</div>
              <div class="choice-btn selected" onclick="toggleCond(this,'intl-block','radio')" data-val="no"><div class="choice-dot"></div>No</div>
            </div>
          </div>
        </div>
        <div class="cond-block" id="intl-block">
          <div class="frow">
            <div class="fgroup"><label class="flabel">Visa Type</label><input type="text" id="visa_type" placeholder="e.g. Student Visa (9f)"></div>
            <div class="fgroup"><label class="flabel">Visa Expiry</label>
              <div class="date-row" style="margin-top:4px">
                <div class="fgroup month-wrap">
                  <input type="text" class="month-input" id="visa_month" placeholder="Month" autocomplete="off" oninput="filterMonths(this,'vm-drop')" onfocus="openDropdown('vm-drop')" onblur="closeDropdown('vm-drop',300)">
                  <div class="month-dropdown" id="vm-drop"></div>
                </div>
                <div class="fgroup" style="max-width:70px"><input type="number" id="visa_day" placeholder="Day" min="1" max="31"></div>
                <div class="fgroup" style="max-width:90px"><input type="number" id="visa_year" placeholder="Year" min="2024" max="2035"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-head"><div class="card-head-bar"></div><div class="card-head-title">Emergency Contact</div></div>
      <div class="card-body">
        <div class="frow">
          <div class="fgroup">
            <label class="flabel">Contact Name <span class="req">*</span></label>
            <input type="text" id="ec_name" placeholder="Parent / Guardian name">
            <div class="err-msg" id="err_ec_name">This field is required.</div>
          </div>
          <div class="fgroup">
            <label class="flabel">Relationship</label>
            <select id="ec_relation">
              <option value="">Select…</option>
              <option>Parent – Mother</option>
              <option>Parent – Father</option>
              <option>Guardian</option>
              <option>Sibling</option>
              <option>Grandparent</option>
              <option>Other Relative</option>
            </select>
          </div>
          <div class="fgroup">
            <label class="flabel">Contact Number <span class="req">*</span></label>
            <input type="text" id="ec_phone" placeholder="e.g. 09XX-XXX-XXXX">
            <div class="err-msg" id="err_ec_phone">This field is required.</div>
          </div>
        </div>
      </div>
    </div>

    <div class="nav-row">
      <button class="btn-secondary" onclick="goPrev(4)">← Back</button>
      <button class="btn-primary" onclick="goNext(4)">Review &amp; Submit →</button>
    </div>
  </div>
</div>

<!-- ═══════════════ STEP 5: Summary/Review ═══════════════ -->
<div class="page" id="page-5">
  <div class="container">
    <div class="summary-warn">
      <div class="warn-icon">⚠️</div>
      <div class="warn-text">
        <strong>Please review carefully before submitting.</strong>
        Once submitted, no further edits will be allowed. Verify all information is correct. If you need to change anything, use the Edit button below.
      </div>
    </div>
    <div class="card">
      <div class="card-head"><div class="card-head-bar"></div><div class="card-head-title">Registration Summary</div></div>
      <div class="card-body" id="summaryContent"></div>
    </div>
    <div class="nav-row">
      <button class="btn-secondary btn-danger" style="color:#fff;border-color:#c0392b" onclick="editForm()">✏️ Edit Information</button>
      <button class="btn-primary btn-gold" onclick="submitForm()">✅ Submit Registration</button>
    </div>
  </div>
</div>

<!-- ═══════════════ RECEIPT ═══════════════ -->
<div class="page" id="page-receipt">
  <div class="container">
    <div class="receipt">
      <div class="confetti">🎉</div>
      <div class="receipt-top">
        <div class="receipt-badge">Registration Successful</div>
        <h2>You're enrolled!</h2>
        <p>Official registration receipt — please keep for your records.</p>
      </div>
      <div class="receipt-body">
        <div class="receipt-name" id="rec-name"></div>
        <div class="receipt-date" id="rec-date"></div>
        <hr class="receipt-divider">
        <div id="rec-details"></div>
        <hr class="receipt-divider">
        <div class="receipt-ref">
          <div class="ref-label">Reference Number</div>
          <div class="ref-num" id="rec-ref"></div>
        </div>
      </div>
    </div>
    <p style="text-align:center;font-size:12px;color:var(--muted);margin-top:20px">Lab Activity 1 — PHP Variable &amp; Control Structures</p>
  </div>
</div>

<script>
const MONTHS = ['January','February','March','April','May','June','July','August','September','October','November','December'];
const STEPS = ['Student Info','Prev. School','Health Info','Citizenship','Review'];
let currentStep = 0;

// ── Build progress bar ──
function buildProgress() {
  const wrap = document.getElementById('progressSteps');
  wrap.innerHTML = STEPS.map((s,i) => `
    <div class="p-step" id="pstep-${i+1}">
      <div class="p-dot">${i+1}</div>
      <div class="p-label">${s}</div>
    </div>`).join('');
}

function updateProgress(step) {
  for(let i=1;i<=5;i++) {
    const el = document.getElementById('pstep-'+i);
    if(!el) continue;
    el.className = 'p-step' + (i<step?' done':i===step?' active':'');
    const dot = el.querySelector('.p-dot');
    dot.innerHTML = i<step ? '✓' : i;
  }
}

function showPage(id) {
  document.querySelectorAll('.page').forEach(p=>p.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  window.scrollTo({top:0,behavior:'smooth'});
}

function startForm() {
  document.getElementById('progressBar').style.display='block';
  buildProgress();
  currentStep=1;
  updateProgress(1);
  showPage('page-1');
}

function goPrev(step) {
  currentStep = step-1;
  updateProgress(currentStep);
  showPage('page-'+(step-1));
}

function goNext(step) {
  if(!validateStep(step)) return;
  currentStep = step+1;
  if(step===4) {
    buildSummary();
    updateProgress(5);
    showPage('page-5');
  } else {
    updateProgress(currentStep);
    showPage('page-'+currentStep);
  }
}

// ── Month dropdown ──
function initMonthDropdowns() {
  document.querySelectorAll('.month-dropdown').forEach(dd => {
    dd.innerHTML = MONTHS.map((m,i)=>`<div class="month-opt" data-val="${m}" onclick="selectMonth(this,'${dd.id}')">${m}</div>`).join('');
  });
}
function filterMonths(inp, ddId) {
  const q = inp.value.toLowerCase();
  const dd = document.getElementById(ddId);
  dd.querySelectorAll('.month-opt').forEach(opt => {
    opt.style.display = opt.textContent.toLowerCase().startsWith(q) ? '' : 'none';
  });
  openDropdown(ddId);
  if(MONTHS.find(m=>m.toLowerCase()===q)) closeDropdown(ddId, 0);
  const matches = MONTHS.filter(m=>m.toLowerCase().startsWith(q));
  if(matches.length===1) { inp.value=matches[0]; closeDropdown(ddId,0); }
}
function openDropdown(id) { document.getElementById(id).classList.add('open'); }
function closeDropdown(id, delay) { setTimeout(()=>document.getElementById(id).classList.remove('open'), delay); }
function selectMonth(el, ddId) {
  const inp = el.closest('.month-wrap').querySelector('input');
  inp.value = el.dataset.val;
  closeDropdown(ddId, 0);
}

// ── Choice buttons ──
function selectRadio(el, groupId, hiddenId) {
  document.querySelectorAll('#'+groupId+' .choice-btn').forEach(b=>b.classList.remove('selected'));
  el.classList.add('selected');
  if(hiddenId) document.getElementById(hiddenId).value = el.dataset.val;
}

function toggleCheck(el) {
  el.classList.toggle('selected');
}

function toggleCond(el, blockId, type) {
  const parent = el.parentElement;
  const btns = parent.querySelectorAll('.choice-btn');
  btns.forEach(b=>b.classList.remove('selected'));
  el.classList.add('selected');
  const block = document.getElementById(blockId);
  if(el.dataset.val==='yes') block.classList.add('visible');
  else block.classList.remove('visible');
  // store hidden values where needed
  const hiddenMap = {'transfer-block':'is_transferee','health-block':'has_medical'};
  for(const [bId,hId] of Object.entries(hiddenMap)) {
    if(blockId===bId && document.getElementById(hId)) {
      document.getElementById(hId).value = el.dataset.val;
    }
  }
}

// Reason for transfer – show other field
document.addEventListener('change', function(e){
  const sel = document.getElementById('reason_transfer');
  if(sel) {
    const row = document.getElementById('reason-other-row');
    if(row) row.style.display = sel.value==='Other' ? 'flex' : 'none';
  }
});
// Also on input for select
document.addEventListener('input', function(e){
  if(e.target && e.target.id==='reason_transfer') {
    const row = document.getElementById('reason-other-row');
    if(row) row.style.display = e.target.value==='Other' ? 'flex' : 'none';
  }
});

// ── Validation ──
function req(id, errId) {
  const el = document.getElementById(id);
  const err = document.getElementById(errId);
  if(!el) return true;
  if(!el.value.trim()) {
    el.classList.add('invalid');
    if(err) err.classList.add('show');
    return false;
  }
  el.classList.remove('invalid');
  if(err) err.classList.remove('show');
  return true;
}

function validateStep(step) {
  let ok = true;
  if(step===1) {
    ok = req('last_name','err_last_name') & ok;
    ok = req('first_name','err_first_name') & ok;
    const g = document.getElementById('gender_val');
    const ge = document.getElementById('err_gender');
    if(!g.value) { ge.classList.add('show'); ok=false; }
    else ge.classList.remove('show');
    const bm = document.getElementById('birth_month').value;
    const bd = document.getElementById('birth_day').value;
    const by = document.getElementById('birth_year').value;
    const be = document.getElementById('err_birth');
    if(!bm||!bd||!by) { be.classList.add('show'); ok=false; }
    else be.classList.remove('show');
  }
  if(step===4) {
    ok = req('birth_country','err_birth_country') & ok;
    ok = req('citizenship','err_citizenship') & ok;
    ok = req('ec_name','err_ec_name') & ok;
    ok = req('ec_phone','err_ec_phone') & ok;
  }
  if(!ok) { const inv = document.querySelector('.invalid, .err-msg.show'); if(inv) inv.scrollIntoView({behavior:'smooth',block:'center'}); }
  return ok;
}

// ── Summary ──
function v(id){ const el=document.getElementById(id); return el ? el.value.trim() : ''; }
function buildSummary() {
  const isTransferee = v('is_transferee')==='yes';
  const hasMedical = v('has_medical')==='yes';
  const langs = [...document.querySelectorAll('#lang-group .choice-btn.selected')].map(b=>b.dataset.val).join(', ');
  const birthDate = [v('birth_month'),v('birth_day'),v('birth_year')].filter(Boolean).join(' ');
  const ldaDate = [v('lda_month'),v('lda_day'),v('lda_year')].filter(Boolean).join(' ');
  let html = '';
  html += sumSection('Student Information',[
    ['Legal Name', `${v('last_name').toUpperCase()}, ${v('first_name')} ${v('middle_name')}`],
    ['Gender', v('gender_val')||'—'],
    ['Date of Birth', birthDate||'—'],
    ['Preferred Name', (v('pref_first_name')||v('pref_last_name')) ? `${v('pref_last_name')}, ${v('pref_first_name')} ${v('pref_middle_name')}` : 'Same as legal name'],
  ]);
  html += sumSection('Previous School',[
    ['Transferee', isTransferee?'Yes':'No, first-time enrollee'],
    ...(isTransferee ? [
      ['Previous School', v('prev_school_name')||'—'],
      ['Last Attended', ldaDate||'—'],
      ['Grade', v('grade_prev_school')||'—'],
      ['Language(s)', langs||'—'],
      ['Reason for Transfer', v('reason_transfer')==='Other' ? v('reason_other') : (v('reason_transfer')||'—')],
    ]:[])
  ]);
  html += sumSection('Health Information',[
    ['Medical Conditions', hasMedical ? 'Declared (see below)' : 'None reported'],
    ...(hasMedical ? [
      ['Condition(s)', v('medical_conditions')||'—'],
      ['Allergies', v('allergies')||'None'],
      ['Medications', v('medications')||'None'],
    ]:[])
  ]);
  html += sumSection('Citizenship & Contact',[
    ['Birth Country', v('birth_country')||'—'],
    ['Citizenship', v('citizenship')||'—'],
    ['Emergency Contact', v('ec_name')||'—'],
    ['Relationship', v('ec_relation')||'—'],
    ['Contact Number', v('ec_phone')||'—'],
  ]);
  document.getElementById('summaryContent').innerHTML = html;
}
function sumSection(title, rows) {
  const items = rows.map(([k,val])=>`<div class="sum-item"><div class="sum-key">${k}</div><div class="sum-val${k==='Legal Name'?' em':''}">${val}</div></div>`).join('');
  return `<div class="sum-section"><div class="sum-section-title">${title}</div><div class="sum-grid">${items}</div></div>`;
}

// ── Edit ──
function editForm() {
  currentStep=4;
  updateProgress(4);
  showPage('page-4');
}

// ── Submit → Receipt ──
function submitForm() {
  const now = new Date();
  const dateStr = now.toLocaleDateString('en-PH',{weekday:'long',year:'numeric',month:'long',day:'numeric'});
  const timeStr = now.toLocaleTimeString('en-PH',{hour:'2-digit',minute:'2-digit',second:'2-digit'});
  const ref = 'REG-' + now.getFullYear() + '-' + String(Math.floor(Math.random()*90000)+10000);
  const fullName = `${v('last_name').toUpperCase()}, ${v('first_name')} ${v('middle_name')}`.trim();
  const birthDate = [v('birth_month'),v('birth_day'),v('birth_year')].filter(Boolean).join(' ');
  document.getElementById('rec-name').textContent = fullName;
  document.getElementById('rec-date').textContent = `Registered on ${dateStr} at ${timeStr}`;
  document.getElementById('rec-ref').textContent = ref;
  document.getElementById('rec-details').innerHTML = `
    <div class="receipt-row"><span>Date of Birth</span><span>${birthDate||'—'}</span></div>
    <div class="receipt-row"><span>Gender</span><span>${v('gender_val')||'—'}</span></div>
    <div class="receipt-row"><span>Citizenship</span><span>${v('citizenship')||'—'}</span></div>
    <div class="receipt-row"><span>Emergency Contact</span><span>${v('ec_name')||'—'}</span></div>
    <div class="receipt-row"><span>Registration Date</span><span>${dateStr}</span></div>
    <div class="receipt-row"><span>Registration Time</span><span>${timeStr}</span></div>
  `;
  updateProgress(6);
  document.getElementById('progressBar').style.display='none';
  showPage('page-receipt');
}

// ── Init ──
initMonthDropdowns();
</script>
</body>
</html>