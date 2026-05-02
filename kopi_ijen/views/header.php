<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Kopi Ijen' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #100c08;
            --surface:   #1a1410;
            --card:      #201912;
            --border:    #2e2318;
            --accent:    #c8862a;
            --accent2:   #8b4513;
            --gold:      #e8b86d;
            --cream:     #f5ead6;
            --danger:    #dc4a38;
            --success:   #5a9e6f;
            --text:      #f0e8d8;
            --muted:     #7a6a55;
            --radius:    12px;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            background-image:
                radial-gradient(ellipse 70% 50% at 10% 0%, rgba(200,134,42,.12) 0%, transparent 55%),
                radial-gradient(ellipse 50% 40% at 90% 100%, rgba(139,69,19,.1) 0%, transparent 55%);
        }

        /* ── NAV ─────────────────────────────── */
        nav {
            position: sticky; top: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 2.5rem;
            height: 68px;
            background: rgba(16,12,8,.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }
        .nav-brand {
            display: flex; align-items: center; gap: .9rem;
            text-decoration: none;
        }
        .nav-logo {
            width: 38px; height: 38px; border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 0 18px rgba(200,134,42,.35);
        }
        .nav-brand-text { display: flex; flex-direction: column; line-height: 1.15; }
        .nav-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem; font-weight: 900;
            color: var(--gold); letter-spacing: .01em;
        }
        .nav-brand-sub { font-size: .65rem; color: var(--muted); letter-spacing: .12em; text-transform: uppercase; }
        .nav-link {
            display: inline-flex; align-items: center; gap: .45rem;
            padding: .5rem 1rem; border-radius: 8px;
            font-size: .82rem; font-weight: 500;
            color: var(--muted); text-decoration: none;
            transition: color .2s, background .2s;
        }
        .nav-link:hover { color: var(--gold); background: var(--card); }

        /* ── WRAPPER ─────────────────────────── */
        .wrapper { max-width: 1020px; margin: 0 auto; padding: 2.5rem 1.5rem 5rem; }

        /* ── PAGE HEADER ─────────────────────── */
        .page-header { margin-bottom: 2rem; }
        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3.5vw, 2.6rem);
            font-weight: 900; letter-spacing: -.01em;
            color: var(--cream); line-height: 1.1;
        }
        .page-header h1 em { font-style: italic; color: var(--gold); }
        .page-header p { color: var(--muted); font-size: .88rem; margin-top: .5rem; }

        /* ── STATS ───────────────────────────── */
        .stats-row {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(155px,1fr));
            gap: 1rem; margin-bottom: 1.75rem;
        }
        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.2rem 1.4rem;
            position: relative; overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, var(--accent), var(--accent2));
        }
        .stat-label { font-size: .7rem; color: var(--muted); letter-spacing: .1em; text-transform: uppercase; font-weight: 600; }
        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 2.1rem; font-weight: 700; margin-top: .3rem;
            color: var(--gold);
        }
        .stat-value.small { font-size: 1.3rem; margin-top: .5rem; }

        /* ── CARD ────────────────────────────── */
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }

        /* ── TOOLBAR ─────────────────────────── */
        .toolbar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.1rem 1.4rem;
            border-bottom: 1px solid var(--border);
            gap: 1rem; flex-wrap: wrap;
        }
        .toolbar-info { font-size: .82rem; color: var(--muted); display: flex; align-items: center; gap: .5rem; }

        /* ── TABLE ───────────────────────────── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead { background: var(--surface); }
        thead th {
            padding: .9rem 1.1rem;
            text-align: left;
            font-size: .7rem; font-weight: 600;
            letter-spacing: .1em; text-transform: uppercase;
            color: var(--muted);
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }
        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .15s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(200,134,42,.04); }
        td { padding: .9rem 1.1rem; font-size: .88rem; vertical-align: middle; }

        /* Tags & badges */
        .badge-no {
            display: inline-flex; align-items: center; justify-content: center;
            width: 26px; height: 26px; border-radius: 7px;
            background: var(--surface);
            font-size: .72rem; font-weight: 600; color: var(--muted);
        }
        .kode-tag {
            font-family: 'Outfit', monospace;
            font-size: .78rem; font-weight: 600;
            color: var(--gold);
            background: rgba(200,134,42,.12);
            padding: .2rem .6rem; border-radius: 6px;
            letter-spacing: .04em;
        }
        .jenis-pill {
            font-size: .75rem; font-weight: 500;
            color: #c4a46e;
            background: rgba(139,69,19,.2);
            border: 1px solid rgba(200,134,42,.2);
            padding: .2rem .65rem; border-radius: 20px;
            white-space: nowrap;
        }
        .harga-text {
            font-weight: 600; color: var(--gold);
            font-size: .88rem;
        }
        .stok-badge {
            display: inline-flex; align-items: center; gap: .3rem;
            font-size: .78rem; font-weight: 500;
        }
        .stok-badge.ok   { color: #6dbf85; }
        .stok-badge.low  { color: #e8a644; }
        .stok-badge.out  { color: var(--danger); }
        .stok-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: currentColor; flex-shrink: 0;
        }

        /* ── BUTTONS ─────────────────────────── */
        .btn {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .55rem 1.1rem; border-radius: 9px;
            font-family: 'Outfit', sans-serif;
            font-size: .82rem; font-weight: 500;
            cursor: pointer; border: none;
            text-decoration: none; transition: all .2s;
            white-space: nowrap;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            color: #fff;
            box-shadow: 0 0 18px rgba(200,134,42,.3);
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 0 28px rgba(200,134,42,.5); }
        .btn-ghost {
            background: var(--surface); color: var(--text);
            border: 1px solid var(--border);
        }
        .btn-ghost:hover { border-color: var(--accent); color: var(--gold); }
        .btn-danger {
            background: rgba(220,74,56,.1); color: var(--danger);
            border: 1px solid rgba(220,74,56,.2);
        }
        .btn-danger:hover { background: rgba(220,74,56,.2); }
        .btn-sm { padding: .38rem .75rem; font-size: .76rem; }

        /* ── FORM ────────────────────────────── */
        .form-wrap { padding: 2rem; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; }
        .form-group { margin-bottom: 0; }
        .form-group.full { grid-column: 1 / -1; }
        label {
            display: block; font-size: .78rem; font-weight: 600;
            color: var(--muted); margin-bottom: .4rem;
            letter-spacing: .04em; text-transform: uppercase;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: .72rem 1rem;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 9px;
            color: var(--text);
            font-family: 'Outfit', sans-serif;
            font-size: .88rem;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            appearance: none;
        }
        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(200,134,42,.15);
        }
        input::placeholder { color: var(--muted); opacity: .7; }
        .select-wrap { position: relative; }
        .select-wrap::after {
            content: '▾';
            position: absolute; right: .9rem; top: 50%; transform: translateY(-50%);
            color: var(--muted); pointer-events: none; font-size: .8rem;
        }
        select option { background: var(--surface); }
        .field-hint { font-size: .72rem; color: var(--muted); margin-top: .3rem; }
        .form-actions { display: flex; gap: .75rem; margin-top: 2rem; }
        .form-divider {
            grid-column: 1/-1;
            border: none; border-top: 1px solid var(--border);
            margin: .4rem 0;
        }

        /* ── ALERT ───────────────────────────── */
        .alert {
            padding: .85rem 1.1rem; border-radius: 10px;
            font-size: .85rem; margin-bottom: 1.5rem;
            display: flex; align-items: center; gap: .6rem;
        }
        .alert-success { background: rgba(90,158,111,.1); border: 1px solid rgba(90,158,111,.25); color: #7dcf97; }
        .alert-error   { background: rgba(220,74,56,.1); border: 1px solid rgba(220,74,56,.25); color: #f08070; }

        /* ── EMPTY ───────────────────────────── */
        .empty { text-align: center; padding: 4rem 2rem; color: var(--muted); }
        .empty-icon { font-size: 2.5rem; opacity: .25; margin-bottom: 1rem; }
        .empty p { font-size: .88rem; }

        /* ── DETAIL CARD ─────────────────────── */
        .card-meta {
            padding: .85rem 1.25rem;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; gap: .75rem;
            flex-wrap: wrap;
        }

        @media (max-width: 640px) {
            nav { padding: 0 1rem; }
            .wrapper { padding: 1.5rem 1rem 3rem; }
            .form-grid { grid-template-columns: 1fr; }
            .form-group.full { grid-column: 1; }
        }
    </style>
</head>
<body>

<nav>
    <a href="index.php" class="nav-brand">
        <div class="nav-logo">☕</div>
        <div class="nav-brand-text">
            <span class="nav-brand-name">Kopi Ijen</span>
            <span class="nav-brand-sub">Manajemen Produk</span>
        </div>
    </a>
    <a href="index.php" class="nav-link">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        Dashboard
    </a>
</nav>
