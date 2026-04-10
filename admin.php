<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tea Port — Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
:root {
    --dark: #1A0F0A;
    --chai: #8D5524;
    --orange: #E67E22;
    --green: #27AE60;
    --red: #E74C3C;
    --blue: #2980B9;
    --purple: #8E44AD;
    --cream: #FDF5E6;
    --card: white;
    --border: #F0E8DC;
    --text: #3E2723;
    --muted: #999;
}
body { background: #F7F2EC; font-family: 'DM Sans', sans-serif; color: var(--text); min-height: 100vh; }

/* ── SIDEBAR ── */
.layout { display: flex; min-height: 100vh; }
.sidebar {
    width: 220px; flex-shrink: 0;
    background: var(--dark);
    padding: 28px 0;
    position: sticky; top: 0; height: 100vh;
    overflow-y: auto;
}
@media (max-width: 700px) { .sidebar { display: none; } .mobile-topbar { display: flex !important; } }
.sidebar-logo {
    font-family: 'Playfair Display', serif;
    color: #F5E6CA;
    font-size: 22px;
    padding: 0 20px 28px;
    border-bottom: 1px solid rgba(255,255,255,0.06);
}
.sidebar-logo span { display: block; font-size: 11px; color: var(--orange); letter-spacing: 2px; text-transform: uppercase; margin-top: 2px; font-family: 'DM Sans', sans-serif; }
.nav-item {
    display: flex; align-items: center; gap: 10px;
    padding: 12px 20px;
    color: rgba(255,255,255,0.5);
    font-size: 14px;
    cursor: pointer;
    transition: all 0.15s;
    border-left: 3px solid transparent;
    margin-top: 2px;
}
.nav-item:hover { color: white; background: rgba(255,255,255,0.04); }
.nav-item.active { color: white; border-left-color: var(--orange); background: rgba(230,126,34,0.1); }
.nav-icon { font-size: 16px; width: 20px; text-align: center; }

/* ── MAIN ── */
.main { flex: 1; padding: 28px 24px; max-width: 900px; }
.mobile-topbar {
    display: none;
    background: var(--dark);
    padding: 14px 16px;
    align-items: center;
    justify-content: space-between;
    position: sticky; top: 0; z-index: 50;
}
.mobile-topbar h2 { font-family: 'Playfair Display', serif; color: #F5E6CA; font-size: 18px; }
.tab-pills { display: flex; gap: 6px; overflow-x: auto; padding-bottom: 4px; }
.tab-pill { flex-shrink: 0; padding: 6px 14px; border-radius: 50px; font-size: 12px; font-weight: 500; background: rgba(255,255,255,0.1); color: white; cursor: pointer; border: none; font-family: 'DM Sans', sans-serif; transition: background 0.15s; }
.tab-pill.active { background: var(--orange); }

.section { display: none; }
.section.active { display: block; }

.page-title { font-family: 'Playfair Display', serif; font-size: 24px; color: var(--text); margin-bottom: 6px; }
.page-sub { color: var(--muted); font-size: 14px; margin-bottom: 24px; }

/* ── STAT CARDS ── */
.stat-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 14px; margin-bottom: 28px; }
.stat-card { background: white; border-radius: 16px; padding: 18px; border: 1px solid var(--border); }
.stat-label { font-size: 12px; color: var(--muted); margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
.stat-val { font-size: 26px; font-weight: 600; color: var(--text); }
.stat-sub { font-size: 12px; color: var(--green); margin-top: 4px; }

/* ── CARDS ── */
.card { background: white; border-radius: 18px; border: 1px solid var(--border); padding: 22px; margin-bottom: 20px; }
.card-title { font-size: 15px; font-weight: 600; color: var(--text); margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
.badge { display: inline-block; padding: 3px 10px; border-radius: 50px; font-size: 11px; font-weight: 600; }
.badge-green { background: #E8F8EE; color: #1E7E4A; }
.badge-orange { background: #FEF0E4; color: #C0581A; }
.badge-red { background: #FDECEA; color: #B71C1C; }
.badge-blue { background: #E3F2FD; color: #0D47A1; }
.badge-purple { background: #F3E5F5; color: #6A1B9A; }

/* ── ORDERS TABLE ── */
.orders-table { width: 100%; border-collapse: collapse; font-size: 13px; }
.orders-table th { text-align: left; padding: 8px 12px; color: var(--muted); font-weight: 500; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid var(--border); }
.orders-table td { padding: 12px; border-bottom: 1px solid #FAFAF8; vertical-align: top; }
.orders-table tr:last-child td { border-bottom: none; }
.orders-table tr:hover td { background: #FDFAF7; }
.order-items { color: var(--muted); font-size: 12px; margin-top: 3px; }
.status-btn { padding: 5px 12px; border-radius: 8px; border: none; font-size: 12px; cursor: pointer; font-family: 'DM Sans', sans-serif; font-weight: 500; transition: all 0.15s; }
.status-btn.pending { background: #FEF0E4; color: #C0581A; }
.status-btn.preparing { background: #E3F2FD; color: #1565C0; }
.status-btn.done { background: #E8F8EE; color: #1E7E4A; }

/* ── CUSTOMER LIST ── */
.cust-row { display: flex; align-items: center; gap: 12px; padding: 14px 0; border-bottom: 1px solid var(--border); }
.cust-row:last-child { border-bottom: none; }
.avatar { width: 40px; height: 40px; border-radius: 50%; background: var(--cream); display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; border: 1px solid var(--border); font-weight: 600; color: var(--chai); font-family: 'DM Sans', sans-serif; }
.cust-info h4 { font-size: 14px; font-weight: 500; color: var(--text); }
.cust-info p { font-size: 12px; color: var(--muted); margin-top: 2px; }
.cust-pts { margin-left: auto; text-align: right; }
.pts-num { font-size: 16px; font-weight: 700; color: var(--orange); }
.pts-lbl { font-size: 11px; color: var(--muted); }
.btn-notify { padding: 6px 14px; border-radius: 8px; border: 1px solid #DDD; background: white; font-size: 12px; cursor: pointer; color: var(--text); font-family: 'DM Sans', sans-serif; margin-left: 8px; transition: all 0.15s; }
.btn-notify:hover { background: #E8F8EE; border-color: #27AE60; color: #1E7E4A; }

.search-bar { width: 100%; padding: 12px 16px; border: 1.5px solid var(--border); border-radius: 12px; font-size: 14px; font-family: 'DM Sans', sans-serif; margin-bottom: 16px; outline: none; background: #FDFAF7; color: var(--text); }
.search-bar:focus { border-color: var(--orange); }

/* ── LOYALTY ── */
.pts-bar { background: var(--border); border-radius: 50px; height: 10px; overflow: hidden; margin: 8px 0; }
.pts-fill { height: 100%; background: linear-gradient(to right, var(--orange), var(--chai)); border-radius: 50px; transition: width 0.5s ease; }
.milestone { display: flex; align-items: center; gap: 10px; padding: 10px; background: #FFF8F0; border-radius: 12px; margin-bottom: 8px; }
.milestone-icon { font-size: 22px; }
.milestone-info { flex: 1; font-size: 13px; }
.milestone-info strong { display: block; color: var(--text); }
.milestone-info span { color: var(--muted); }

/* ── OFFERS ── */
.offer-form { display: grid; gap: 14px; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
@media (max-width: 500px) { .form-row { grid-template-columns: 1fr; } }
.f-group label { display: block; font-size: 12px; font-weight: 500; color: var(--muted); margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
.f-group input, .f-group select, .f-group textarea {
    width: 100%; padding: 12px 14px;
    border: 1.5px solid var(--border); border-radius: 12px;
    font-size: 14px; font-family: 'DM Sans', sans-serif;
    background: #FDFAF7; color: var(--text); outline: none;
    transition: border-color 0.15s;
}
.f-group input:focus, .f-group select:focus, .f-group textarea:focus { border-color: var(--orange); }
.f-group textarea { resize: vertical; min-height: 80px; }
.btn-primary { padding: 13px 28px; background: var(--dark); color: white; border: none; border-radius: 12px; font-size: 14px; font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: all 0.2s; }
.btn-primary:hover { background: var(--chai); }
.btn-success { background: var(--green); }
.btn-wa { background: #25D366; }
.btn-sms { background: var(--blue); }

.offer-chips { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 16px; }
.offer-chip { padding: 8px 16px; border-radius: 50px; border: 1.5px solid var(--border); background: white; font-size: 13px; cursor: pointer; transition: all 0.15s; color: var(--text); }
.offer-chip:hover, .offer-chip.active { border-color: var(--orange); background: #FEF0E4; color: var(--chai); }

/* ── SEND PANEL ── */
.cust-select-row { display: flex; align-items: center; gap: 10px; padding: 10px 0; border-bottom: 1px solid var(--border); }
.cust-select-row:last-child { border-bottom: none; }
.cust-check { width: 18px; height: 18px; accent-color: var(--orange); cursor: pointer; flex-shrink: 0; }
.msg-preview {
    background: #E8F5E9;
    border-radius: 16px 16px 16px 4px;
    padding: 14px 18px;
    font-size: 14px;
    color: var(--dark);
    line-height: 1.6;
    margin: 14px 0;
    border: 1px solid #C8E6C9;
}
.send-row { display: flex; gap: 10px; flex-wrap: wrap; }
.toast { position: fixed; bottom: 28px; right: 20px; background: var(--dark); color: white; padding: 12px 20px; border-radius: 12px; font-size: 14px; z-index: 999; opacity: 0; transform: translateY(10px); transition: all 0.3s; pointer-events: none; }
.toast.show { opacity: 1; transform: translateY(0); }
</style>
</head>
<body>

<div class="mobile-topbar">
    <h2>☕ Tea Port Admin</h2>
    <div class="tab-pills">
        <button class="tab-pill active" onclick="switchTab('orders',this)">Orders</button>
        <button class="tab-pill" onclick="switchTab('customers',this)">Customers</button>
        <button class="tab-pill" onclick="switchTab('loyalty',this)">Loyalty</button>
        <button class="tab-pill" onclick="switchTab('offers',this)">Offers</button>
        <button class="tab-pill" onclick="switchTab('send',this)">Send</button>
    </div>
</div>

<div class="layout">
<!-- SIDEBAR -->
<nav class="sidebar">
    <div class="sidebar-logo">☕ Tea Port<span>Admin Panel</span></div>
    <div class="nav-item active" onclick="switchTab('orders',this)" data-tab="orders">
        <span class="nav-icon">📋</span> Live Orders
    </div>
    <div class="nav-item" onclick="switchTab('customers',this)" data-tab="customers">
        <span class="nav-icon">👥</span> Customers
    </div>
    <div class="nav-item" onclick="switchTab('loyalty',this)" data-tab="loyalty">
        <span class="nav-icon">⭐</span> Loyalty Points
    </div>
    <div class="nav-item" onclick="switchTab('offers',this)" data-tab="offers">
        <span class="nav-icon">🎁</span> Offers & Coupons
    </div>
    <div class="nav-item" onclick="switchTab('send',this)" data-tab="send">
        <span class="nav-icon">📱</span> Send Messages
    </div>
</nav>

<main class="main">

<!-- ── ORDERS ── -->
<div class="section active" id="sec-orders">
    <div class="page-title">Live Orders</div>
    <div class="page-sub">Real-time orders from all tables today</div>

    <div class="stat-row">
        <div class="stat-card"><div class="stat-label">Today's Orders</div><div class="stat-val" id="s-orders">12</div><div class="stat-sub">↑ 3 from yesterday</div></div>
        <div class="stat-card"><div class="stat-label">Revenue</div><div class="stat-val">₹<span id="s-revenue">840</span></div><div class="stat-sub">↑ ₹120 from yesterday</div></div>
        <div class="stat-card"><div class="stat-label">Pending</div><div class="stat-val" id="s-pending">3</div><div class="stat-sub" style="color:#E67E22">In queue</div></div>
        <div class="stat-card"><div class="stat-label">Avg Order</div><div class="stat-val">₹<span id="s-avg">70</span></div><div class="stat-sub">Per customer</div></div>
    </div>

    <div class="card">
        <div class="card-title">📋 Order Queue <span class="badge badge-orange" id="pendingBadge">3 pending</span></div>
        <div style="overflow-x:auto">
        <table class="orders-table" id="ordersTable">
            <thead>
                <tr><th>Table</th><th>Customer</th><th>Items</th><th>Total</th><th>Time</th><th>Status</th></tr>
            </thead>
            <tbody id="ordersBody"></tbody>
        </table>
        </div>
    </div>
</div>

<!-- ── CUSTOMERS ── -->
<div class="section" id="sec-customers">
    <div class="page-title">Customer Database</div>
    <div class="page-sub">All registered customers and their order history</div>

    <input class="search-bar" type="search" placeholder="🔍  Search by name or phone..." oninput="filterCustomers(this.value)" id="custSearch">

    <div class="card">
        <div class="card-title">👥 All Customers <span class="badge badge-blue" id="custCount">0 registered</span></div>
        <div id="custList"></div>
    </div>
</div>

<!-- ── LOYALTY ── -->
<div class="section" id="sec-loyalty">
    <div class="page-title">Loyalty Points</div>
    <div class="page-sub">₹1 spent = 1 point. Milestones unlock free rewards.</div>

    <div class="card">
        <div class="card-title">🏆 Milestones</div>
        <div class="milestone"><span class="milestone-icon">☕</span><div class="milestone-info"><strong>100 points — Free Classic Tea</strong><span>Our gift for your loyalty</span></div></div>
        <div class="milestone"><span class="milestone-icon">🧁</span><div class="milestone-info"><strong>250 points — Free Snack of Choice</strong><span>Vada, Samosa, or any ₹15 item</span></div></div>
        <div class="milestone"><span class="milestone-icon">🥤</span><div class="milestone-info"><strong>400 points — Free Lassi</strong><span>Any Lassi of your choice</span></div></div>
        <div class="milestone"><span class="milestone-icon">🍕</span><div class="milestone-info"><strong>600 points — Free Combo</strong><span>Tea + Snack + Sundal combo</span></div></div>
        <div class="milestone"><span class="milestone-icon">👑</span><div class="milestone-info"><strong>1000 points — VIP Member</strong><span>10% off all orders, priority service</span></div></div>
    </div>

    <div class="card">
        <div class="card-title">⭐ Top Loyal Customers</div>
        <div id="loyaltyList"></div>
    </div>

    <div class="card">
        <div class="card-title">✏️ Adjust Points</div>
        <div class="offer-form">
            <div class="form-row">
                <div class="f-group"><label>Customer Phone</label><input type="tel" id="adj-phone" placeholder="98765 43210"></div>
                <div class="f-group"><label>Points to Add/Remove</label><input type="number" id="adj-pts" placeholder="e.g. +50 or -100"></div>
            </div>
            <div class="f-group"><label>Reason</label><input type="text" id="adj-reason" placeholder="e.g. Birthday bonus, Redemption"></div>
            <button class="btn-primary" onclick="adjustPoints()">Update Points</button>
        </div>
    </div>
</div>

<!-- ── OFFERS ── -->
<div class="section" id="sec-offers">
    <div class="page-title">Offers & Coupons</div>
    <div class="page-sub">Create festival offers, coupon codes and seasonal deals</div>

    <div class="card">
        <div class="card-title">📂 Active Offers</div>
        <div class="offer-chips">
            <div class="offer-chip active">🪔 Diwali Special — DIWALI20</div>
            <div class="offer-chip">🎂 Birthday Deal — BDAY24</div>
            <div class="offer-chip">🌅 Morning Rush — EARLYBIRD</div>
            <div class="offer-chip">+ Add New</div>
        </div>
    </div>

    <div class="card">
        <div class="card-title">➕ Create New Offer</div>
        <div class="offer-form">
            <div class="form-row">
                <div class="f-group"><label>Offer Title</label><input type="text" id="off-title" placeholder="e.g. Diwali Special"></div>
                <div class="f-group"><label>Coupon Code</label><input type="text" id="off-code" placeholder="e.g. DIWALI20" style="text-transform:uppercase" oninput="this.value=this.value.toUpperCase()"></div>
            </div>
            <div class="form-row">
                <div class="f-group"><label>Discount Type</label>
                    <select id="off-type">
                        <option>Percentage Off (%)</option>
                        <option>Flat Amount Off (₹)</option>
                        <option>Free Item</option>
                        <option>Buy X Get Y</option>
                    </select>
                </div>
                <div class="f-group"><label>Discount Value</label><input type="text" id="off-val" placeholder="e.g. 20 (for 20%)"></div>
            </div>
            <div class="form-row">
                <div class="f-group"><label>Valid From</label><input type="date" id="off-from"></div>
                <div class="f-group"><label>Valid Until</label><input type="date" id="off-to"></div>
            </div>
            <div class="f-group"><label>Description (shown to customer)</label><textarea id="off-desc" placeholder="20% off on all Lassi & Sundal items"></textarea></div>
            <div class="f-group"><label>Applies To</label>
                <select id="off-apply">
                    <option>All Items</option>
                    <option>Tea & Coffee only</option>
                    <option>Snacks & Bakery only</option>
                    <option>Lassi only</option>
                    <option>Fried Items only</option>
                    <option>Minimum order ₹100</option>
                </select>
            </div>
            <button class="btn-primary" onclick="createOffer()">Save & Activate Offer</button>
        </div>
    </div>
</div>

<!-- ── SEND MESSAGES ── -->
<div class="section" id="sec-send">
    <div class="page-title">Send Offers to Customers</div>
    <div class="page-sub">Send WhatsApp or SMS messages with offers and coupon codes</div>

    <div class="card">
        <div class="card-title">🎯 Select Audience</div>
        <div class="offer-chips" id="audienceChips">
            <div class="offer-chip active" onclick="selectAudience(this,'all')">All Customers</div>
            <div class="offer-chip" onclick="selectAudience(this,'top')">Top Spenders (₹500+)</div>
            <div class="offer-chip" onclick="selectAudience(this,'loyal')">Loyalty Members (100+ pts)</div>
            <div class="offer-chip" onclick="selectAudience(this,'new')">New Customers (last 7 days)</div>
            <div class="offer-chip" onclick="selectAudience(this,'inactive')">Inactive (not visited 15+ days)</div>
        </div>

        <div id="custSelectList" style="max-height:260px; overflow-y:auto; margin-top:8px;"></div>

        <div style="display:flex; align-items:center; gap:10px; margin-top:12px; font-size:13px; color:var(--muted);">
            <input type="checkbox" id="selectAll" onchange="toggleSelectAll(this.checked)" style="accent-color:var(--orange); width:16px; height:16px;">
            <label for="selectAll">Select all <span id="selCount">0</span> shown customers</label>
        </div>
    </div>

    <div class="card">
        <div class="card-title">✍️ Compose Message</div>
        <div class="f-group" style="margin-bottom:12px"><label>Choose Offer Template</label>
            <select id="msgTemplate" onchange="applyTemplate(this.value)">
                <option value="">-- Select or write custom --</option>
                <option value="diwali">🪔 Diwali Special (DIWALI20 — 20% off)</option>
                <option value="birthday">🎂 Birthday Treat (Free tea)</option>
                <option value="morning">🌅 Morning Rush (₹5 off before 9 AM)</option>
                <option value="loyalty">⭐ Loyalty Reward (Milestone reached)</option>
                <option value="custom">✏️ Custom Message</option>
            </select>
        </div>
        <div class="f-group">
            <label>Message (WhatsApp/SMS)</label>
            <textarea id="msgBody" rows="5" placeholder="Write your message here..."></textarea>
        </div>
        <div class="msg-preview" id="msgPreview">
            Your message preview will appear here...
        </div>
        <div class="send-row">
            <button class="btn-primary btn-wa" onclick="sendMessages('whatsapp')">📱 Send via WhatsApp</button>
            <button class="btn-primary btn-sms" onclick="sendMessages('sms')">💬 Send via SMS</button>
        </div>
        <div style="margin-top:10px; font-size:12px; color:var(--muted);">Powered by Twilio / TextLocal API (configure in settings)</div>
    </div>
</div>

</main>
</div>

<!-- TOAST -->
<div class="toast" id="toast"></div>

<script>
// ── DEMO DATA ──
let CUSTOMERS = [
    {id:1, name:"Rajan Kumar",    phone:"9876543210", orders:8,  total:620, points:620, last:"2025-07-10"},
    {id:2, name:"Priya S",        phone:"9123456789", orders:5,  total:380, points:380, last:"2025-07-09"},
    {id:3, name:"Mohammed Arif",  phone:"8012345678", orders:12, total:990, points:990, last:"2025-07-10"},
    {id:4, name:"Kavitha R",      phone:"7890123456", orders:3,  total:210, points:210, last:"2025-07-08"},
    {id:5, name:"Siva Shankar",   phone:"9988776655", orders:1,  total:45,  points:45,  last:"2025-07-10"},
    {id:6, name:"Deepa M",        phone:"9876501234", orders:7,  total:540, points:540, last:"2025-07-07"},
];

let ORDERS = [
    {id:"TP001", table:3, name:"Rajan Kumar",   items:["Masala Tea ×2","Samosa ×3"],      total:65,  time:"09:15", status:"done"},
    {id:"TP002", table:7, name:"Priya S",        items:["Mango Lassi ×1","Veg Roll ×2"],  total:110, time:"09:32", status:"preparing"},
    {id:"TP003", table:1, name:"Mohammed Arif",  items:["Filter Coffee ×3","Vada ×2"],    total:75,  time:"09:41", status:"pending"},
    {id:"TP004", table:5, name:"Kavitha R",      items:["Green Tea ×1","Paneer Sandwich"], total:60, time:"09:55", status:"pending"},
    {id:"TP005", table:2, name:"Walk-in",         items:["Classic Tea ×4"],               total:60,  time:"10:02", status:"pending"},
];

const TEMPLATES = {
    diwali:  `🪔 *Happy Diwali from Tea Port!*\n\nAs our special Diwali gift, use code *DIWALI20* for 20% off your next order on all Lassi & Sundal items.\n\nValid till this week only. Come celebrate with us! ☕`,
    birthday:`🎂 *Happy Birthday, {name}!*\n\nAs a birthday gift from Tea Port, your next Tea is completely FREE! Just show this message.\n\nWishing you a wonderful day! 🎉`,
    morning: `🌅 *Good Morning from Tea Port!*\n\nStart your day with us! Use code *EARLYBIRD* for ₹5 off any order before 9 AM today.\n\nSee you soon! ☕`,
    loyalty: `⭐ *You've earned a reward, {name}!*\n\nYou've crossed {points} loyalty points at Tea Port! Come in to redeem your free item. 🎁\n\nThank you for your love! ❤️`,
    custom: ''
};

// ── TAB SWITCHING ──
function switchTab(tab, el) {
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    document.getElementById('sec-'+tab).classList.add('active');

    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    document.querySelectorAll('.tab-pill').forEach(n => n.classList.remove('active'));
    if(el) el.classList.add('active');
    // also match sidebar
    document.querySelectorAll(`.nav-item[data-tab="${tab}"]`).forEach(n=>n.classList.add('active'));
}

// ── ORDERS ──
function renderOrders() {
    const body = document.getElementById('ordersBody');
    body.innerHTML = ORDERS.map(o => `
        <tr>
            <td><strong>Table ${o.table}</strong><div class="order-items">#${o.id}</div></td>
            <td>${o.name}</td>
            <td><div class="order-items">${o.items.join('<br>')}</div></td>
            <td><strong>₹${o.total}</strong></td>
            <td>${o.time}</td>
            <td><button class="status-btn ${o.status}" onclick="cycleStatus('${o.id}',this)">${o.status}</button></td>
        </tr>`).join('');
    const pending = ORDERS.filter(o=>o.status==='pending').length;
    document.getElementById('pendingBadge').textContent = pending + ' pending';
    document.getElementById('s-pending').textContent = pending;
}

function cycleStatus(id, btn) {
    const order = ORDERS.find(o=>o.id===id);
    if(!order) return;
    const cycle = {pending:'preparing', preparing:'done', done:'pending'};
    order.status = cycle[order.status];
    btn.className = 'status-btn ' + order.status;
    btn.textContent = order.status;
    renderOrders();
}

// ── CUSTOMERS ──
function renderCustomers(list) {
    const el = document.getElementById('custList');
    el.innerHTML = list.map(c => {
        const initials = c.name.split(' ').map(x=>x[0]).join('').slice(0,2).toUpperCase();
        const pct = Math.min(100, Math.round(c.points / 6));
        return `<div class="cust-row">
            <div class="avatar">${initials}</div>
            <div class="cust-info">
                <h4>${c.name}</h4>
                <p>📱 ${c.phone} · ${c.orders} orders · Last visit ${c.last}</p>
                <div class="pts-bar" style="width:140px"><div class="pts-fill" style="width:${pct}%"></div></div>
            </div>
            <div class="cust-pts"><div class="pts-num">${c.points}</div><div class="pts-lbl">pts</div></div>
            <button class="btn-notify" onclick="quickNotify('${c.phone}','${c.name}')">Notify</button>
        </div>`;
    }).join('');
    document.getElementById('custCount').textContent = list.length + ' registered';
}

function filterCustomers(q) {
    const filtered = CUSTOMERS.filter(c =>
        c.name.toLowerCase().includes(q.toLowerCase()) || c.phone.includes(q));
    renderCustomers(filtered);
}

// ── LOYALTY LIST ──
function renderLoyalty() {
    const sorted = [...CUSTOMERS].sort((a,b)=>b.points-a.points);
    document.getElementById('loyaltyList').innerHTML = sorted.map((c,i) => {
        const initials = c.name.split(' ').map(x=>x[0]).join('').slice(0,2).toUpperCase();
        const pct = Math.min(100, Math.round(c.points / 6));
        const milestone = c.points>=1000?'👑 VIP':c.points>=600?'🍕 Combo':c.points>=400?'🥤 Lassi':c.points>=250?'🧁 Snack':c.points>=100?'☕ Tea':'🌱 New';
        return `<div class="cust-row">
            <div class="avatar" style="background:${['#FEF0E4','#FDF5E6','#E8F8EE'][i%3]}">${i+1}</div>
            <div class="cust-info">
                <h4>${c.name} <span class="badge badge-orange" style="font-size:11px">${milestone}</span></h4>
                <p>${c.phone} · ₹${c.total} total spent</p>
                <div class="pts-bar" style="width:200px"><div class="pts-fill" style="width:${pct}%"></div></div>
            </div>
            <div class="cust-pts"><div class="pts-num">${c.points}</div><div class="pts-lbl">pts</div></div>
        </div>`;
    }).join('');
}

// ── SEND MESSAGES ──
function renderCustSelect(list) {
    document.getElementById('custSelectList').innerHTML = list.map(c => `
        <div class="cust-select-row">
            <input class="cust-check" type="checkbox" value="${c.phone}" onchange="updateSelCount()">
            <span style="font-size:14px">${c.name}</span>
            <span style="font-size:12px; color:var(--muted); margin-left:auto">${c.phone}</span>
        </div>`).join('');
    updateSelCount();
}

let currentAudience = 'all';
function selectAudience(el, type) {
    document.querySelectorAll('#audienceChips .offer-chip').forEach(c=>c.classList.remove('active'));
    el.classList.add('active');
    currentAudience = type;
    let filtered = CUSTOMERS;
    if(type==='top') filtered = CUSTOMERS.filter(c=>c.total>=500);
    if(type==='loyal') filtered = CUSTOMERS.filter(c=>c.points>=100);
    if(type==='new') filtered = CUSTOMERS.filter(c=>c.orders<=2);
    if(type==='inactive') filtered = CUSTOMERS.filter(c=>c.orders<=3);
    renderCustSelect(filtered);
}

function toggleSelectAll(checked) {
    document.querySelectorAll('.cust-check').forEach(c=>c.checked=checked);
    updateSelCount();
}

function updateSelCount() {
    const n = document.querySelectorAll('.cust-check:checked').length;
    document.getElementById('selCount').textContent = n;
}

function applyTemplate(key) {
    if(!key) return;
    const t = TEMPLATES[key] || '';
    document.getElementById('msgBody').value = t;
    updatePreview();
}

function updatePreview() {
    const msg = document.getElementById('msgBody').value;
    document.getElementById('msgPreview').textContent = msg || 'Your message preview...';
}

function sendMessages(channel) {
    const phones = [...document.querySelectorAll('.cust-check:checked')].map(c=>c.value);
    if(!phones.length) { toast('Please select at least one customer.'); return; }
    const msg = document.getElementById('msgBody').value;
    if(!msg.trim()) { toast('Please write a message first.'); return; }

    // In production: POST to api/send_message.php with {phones, message, channel}
    console.log(`Sending via ${channel} to`, phones, msg);
    toast(`✅ ${channel === 'whatsapp' ? 'WhatsApp' : 'SMS'} sent to ${phones.length} customer(s)!`);
}

function quickNotify(phone, name) {
    switchTab('send', null);
    document.getElementById('msgBody').value = `Hi ${name}! ☕ Thanks for visiting Tea Port. Here's a special offer just for you...`;
    updatePreview();
    toast(`✅ Switched to Send panel for ${name}`);
}

// ── OFFERS ──
function createOffer() {
    const title = document.getElementById('off-title').value;
    const code = document.getElementById('off-code').value;
    if(!title || !code) { toast('Please fill offer title and coupon code.'); return; }
    toast(`✅ Offer "${title}" with code ${code} activated!`);
    document.getElementById('off-title').value = '';
    document.getElementById('off-code').value = '';
}

function adjustPoints() {
    const phone = document.getElementById('adj-phone').value;
    const pts = document.getElementById('adj-pts').value;
    if(!phone || !pts) { toast('Enter phone and points.'); return; }
    toast(`✅ ${pts > 0 ? '+' : ''}${pts} points updated for ${phone}`);
}

// ── TOAST ──
function toast(msg) {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 3000);
}

// ── INIT ──
document.getElementById('msgBody').addEventListener('input', updatePreview);

renderOrders();
renderCustomers(CUSTOMERS);
renderLoyalty();
renderCustSelect(CUSTOMERS);

setInterval(() => {
    // Simulate live order polling
}, 30000);
</script>
</body>
</html>
