<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "techgesture";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM messages ORDER BY submitted_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin - User Messages</title>
<script>
async function exportTableToPDF(tableSelector, filename) {
    const { jsPDF } = window.jspdf;
    const table = document.querySelector(tableSelector);
    
    // Clone the table for clean rendering
    const clone = table.cloneNode(true);
    clone.style.width = "100%"; // prevent cropping
    clone.style.fontSize = "10px"; // optional: shrink font for fitting
    
    const wrapper = document.createElement("div");
    wrapper.style.position = "absolute";
    wrapper.style.left = "-9999px";
    wrapper.appendChild(clone);
    document.body.appendChild(wrapper);

    await html2canvas(clone, {
        scale: 2,
        useCORS: true
    }).then(canvas => {
        const pdf = new jsPDF('l', 'mm', 'a4');
        const imgData = canvas.toDataURL('image/png');
        const imgProps = pdf.getImageProperties(imgData);
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

        pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
        pdf.save(filename);
    });

    document.body.removeChild(wrapper);
}
</script>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    function addSearchAndPagination(tableSelector, rowsPerPage = 5) {
        const table = document.querySelector(tableSelector);
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        const searchInput = document.createElement('input');
        searchInput.type = 'text';
        searchInput.placeholder = '🔍 Search...';
        searchInput.style.cssText = 'margin-bottom:20px;padding:10px;border-radius:5px;border:1px solid #ccc;width:100%;max-width:300px;';

        table.parentElement.insertBefore(searchInput, table);

        let currentPage = 1;

        function renderTable() {
            const filteredRows = rows.filter(row => {
                return row.innerText.toLowerCase().includes(searchInput.value.toLowerCase());
            });

            const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
            currentPage = Math.min(currentPage, totalPages);

            tbody.innerHTML = '';
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            filteredRows.slice(start, end).forEach(row => tbody.appendChild(row));

            pagination.innerHTML = '';
            if (totalPages > 1) {
                for (let i = 1; i <= totalPages; i++) {
                    const btn = document.createElement('button');
                    btn.textContent = i;
                    btn.style.cssText = `margin: 5px; padding: 6px 12px; border: none; border-radius: 5px; background: ${i === currentPage ? '#4e73df' : '#ccc'}; color: white; cursor: pointer;`;
                    btn.onclick = () => {
                        currentPage = i;
                        renderTable();
                    };
                    pagination.appendChild(btn);
                }
            }
        }

        const pagination = document.createElement('div');
        pagination.style.textAlign = 'center';
        pagination.style.marginTop = '10px';
        table.parentElement.appendChild(pagination);

        searchInput.addEventListener('input', renderTable);

        renderTable();
    }

    addSearchAndPagination('table:nth-of-type(1)');
    addSearchAndPagination('table:nth-of-type(2)');
});
</script>

    <style>
        /* Reset and base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e0eafc, #cfdef3);
            padding: 40px 20px;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

       h2 {
    text-align: center;
    margin-bottom: 30px;
    font-weight: 700;
    font-size: 2rem;
    background: linear-gradient(90deg, #4e73df, #1a48c5);

    /* 👇 Vendor prefixes for maximum compatibility */
    -webkit-background-clip: text;      /* Chrome, Safari */
    -moz-background-clip: text;         /* Firefox (legacy) */
    background-clip: text;              /* Standard */

    -webkit-text-fill-color: transparent; /* Required for WebKit */
    -moz-text-fill-color: transparent;    /* Optional: legacy Firefox */
    color: transparent;                   /* Fallback, ensures no solid color appears */

    position: relative;
    animation: fadeInDown 1s ease forwards;
}






/* Search input styles and animation */
input[type="text"] {
  transition: all 0.4s ease;
  border: 1px solid #ccc;
  font-size: 1rem;
  outline: none;
  box-shadow: 0 0 5px transparent;
}

input[type="text"]:focus {
  border-color: #4e73df;
  box-shadow: 0 0 8px rgba(78, 115, 223, 0.7);
  background-color: #f0f4ff;
  transform: scale(1.02);
  transition: all 0.3s ease;
}

/* Styled dropdown with arrow */
select {
  position: relative;
  padding-right: 30px; /* space for arrow */
}

select::-ms-expand {
  display: none;
}

/* Custom arrow */
select {
  background-image: url("data:image/svg+xml;utf8,<svg fill='%23ffffff' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
  background-repeat: no-repeat;
  background-position: right 10px center;
  background-size: 16px 16px;
}

/* Hover and focus effect */
select:hover, select:focus {
  background: linear-gradient(90deg, #1a48c5, #4e73df);
  box-shadow: 0 0 10px rgba(30, 70, 140, 0.5);
  color: #fff;
  outline: none;
  transform: scale(1.05);
  transition: all 0.3s ease;
}



        h2::before {
            content: '📨';
            position: absolute;
            left: -40px;
            font-size: 2.4rem;
            top: 50%;
            transform: translateY(-50%);
        }

        /* Second heading icon */
        h2.comments::before {
            content: '📬';
        }

        table {
            width: 100%;
            max-width: 1100px;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
            box-shadow: 0 8px 30px rgba(30, 70, 140, 0.1);
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 50px;
            animation: fadeInUp 1s ease forwards;
            transition: box-shadow 0.3s ease;
        }

        
.export-buttons {
    margin: 20px 0;
    text-align: center;
}

.export-buttons button {
    background: linear-gradient(90deg, #4e73df, #1a48c5);
    color: #ffffff;
    border: none;
    padding: 12px 24px;
    margin: 8px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 500;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: background-color 0.4s ease, color 0.4s ease, transform 0.3s ease, box-shadow 0.3s ease;
}

.export-buttons button:hover {
    background-color: #ffffff; /* fades to white */
    color: white; /* text turns black */
    transform: scale(1.05); /* subtle zoom */
    box-shadow: 0 8px 16px rgba(3, 48, 173, 0.3);
    border: 1px solid #1a48c5;
}


.export-dropdown-container {
  position: relative;
  width: 250px;
  user-select: none;
  margin: 20px auto;
    margin-bottom: 80px; /* adds spacing below dropdown */

  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.export-dropdown-toggle {
  background: linear-gradient(90deg, #4e73df, #1a48c5);
  color: white;
  padding: 12px 20px;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
  box-shadow: 0 4px 6px rgba(30, 70, 140, 0.3);
  text-align: center;
  transition: background-color 0.3s ease;
}

.export-dropdown-toggle:hover,
.export-dropdown-toggle:focus {
  background: linear-gradient(90deg, #1a48c5, #4e73df);
  outline: none;
}

.export-dropdown-menu {
  position: absolute;
  top: 100%; /* Just below the toggle */
  left: 0;
  right: 0;
  background: white;
  border-radius: 0 0 8px 8px;
  box-shadow: 0 10px 20px rgba(30, 70, 140, 0.2);
  margin-top: 6px;
  opacity: 0;
  visibility: hidden;
  transform-origin: top center;
  transform: translateY(-20px);
  transition: opacity 0.3s ease, transform 0.3s ease, visibility 0.3s;
  z-index: 10;
  max-height: 0;
  overflow: hidden;
  list-style: none;
  padding: 0;
}

.export-dropdown-menu.show {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
  max-height: 400px; /* enough for 4 items */
  overflow: auto;
}

.export-dropdown-menu li {
  padding: 12px 20px;
  cursor: pointer;
  font-weight: 500;
  color: #1a48c5;
  border-bottom: 1px solid #eee;
  transition: background-color 0.25s ease;
}

.export-dropdown-menu li:hover {
  background: #e0eafc;
  color: #4e73df;
}

.export-dropdown-menu li:last-child {
  border-bottom: none;
}


.logout-btn {
  z-index: 1;
  position: relative;
}

        table:hover {
            box-shadow: 0 12px 50px rgba(30, 70, 140, 0.15);
        }

        th, td {
            padding: 18px 22px;
            text-align: left;
            font-size: 1rem;
        }

        th {
            background: linear-gradient(90deg, #4e73df, #1a48c5);
            color: white;
            font-weight: 700;
            letter-spacing: 0.05em;
            user-select: none;
            text-transform: uppercase;
        }

        tbody tr {
            transition: background-color 0.3s ease, transform 0.2s ease;
            cursor: default;
        }

        tbody tr:nth-child(even) {
            background: #f6f9ff;
        }

        tbody tr:hover {
            background-color: #dbe6ff;
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(30, 70, 140, 0.1);
            animation: pulse 1.5s infinite alternate;
        }

        td {
            color: #555;
            vertical-align: middle;
        }

        /* Responsive */
        @media (max-width: 900px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin-bottom: 20px;
                background: white;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(30, 70, 140, 0.1);
                padding: 15px;
                animation: fadeInUp 0.7s ease forwards;
            }

            td {
                padding-left: 50%;
                position: relative;
                font-size: 1rem;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 20px;
                top: 15px;
                font-weight: 700;
                color: #1a48c5;
                font-size: 0.95rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }
        }

        /* Animations */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 10px rgba(30, 70, 140, 0.1); }
            100% { box-shadow: 0 0 20px rgba(30, 70, 140, 0.25); }
        }
    </style>
</head>
<body>
    <h2>📨 User Messages</h2>

    <table>
        <div style="margin-bottom: 20px; text-align: center;">
    <label for="msgDateFilter" style="font-weight:bold; margin-right:10px;">Filter by Date:</label>
    <select id="msgDateFilter" style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
        <option  value="all" style="color: #333;" >All</option>
        <option style="color: #333;"  value="today">Today</option>
        <option style="color: #333;"  value="7days">Last 7 Days</option>
        <option style="color: #333;"  value="30days">Last 30 Days</option>
    </select>
</div>

      <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Subject</th>
        <th>Message</th>
        <th>Submitted At</th>
        <th>Delete</th>
    </tr>
</thead>

        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
    <td data-label="ID"><?= $row['id'] ?></td>
    <td data-label="Name"><?= htmlspecialchars($row['name']) ?></td>
    <td data-label="Email"><?= htmlspecialchars($row['email']) ?></td>
    <td data-label="Subject"><?= htmlspecialchars($row['subject']) ?></td>
    <td data-label="Message"><?= htmlspecialchars($row['message']) ?></td>
    <td data-label="Submitted At"><?= $row['submitted_at'] ?></td>
    <td>
        <form method="POST" action="delete_message.php" onsubmit="return confirm('Are you sure you want to delete this message?');">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">🗑️</button>
        </form>
    </td>
</tr>

            <?php endwhile; ?>
        </tbody>
    </table>


<div style="margin-top: 40px; border-top: 2px solid #ccc;"></div>

    <hr style="margin-top: 40px; border: 1px solid #ccc;">

    <h2 class="comments">📬 User Comments</h2>
    <div style="margin-bottom: 20px; text-align: center;">
    <label for="dateFilter" style="font-weight:bold; margin-right:10px;">Filter by Date:</label>
    <select id="dateFilter" style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
        <option value="all"  style="color: #333;"   >All</option>
        <option value="today" style="color: #333;" >Today</option>
        <option value="7days" style="color: #333;" >Last 7 Days</option>
        <option value="30days" style="color: #333;" >Last 30 Days</option>
    </select>
</div>

    <table>
      <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Comment</th>
        <th>Date</th>
        <th>Delete</th>
    </tr>
</thead>

        <tbody>
        <?php
        $result = $conn->query("SELECT * FROM comments ORDER BY created_at DESC");
       while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td data-label='ID'>{$row['id']}</td>
            <td data-label='Name'>" . htmlspecialchars($row['name']) . "</td>
            <td data-label='Email'>" . htmlspecialchars($row['email']) . "</td>
            <td data-label='Comment'>" . htmlspecialchars($row['comment']) . "</td>
            <td data-label='Date'>{$row['created_at']}</td>
            <td>
                <form method='POST' action='delete_comment.php' onsubmit='return confirm(\"Are you sure you want to delete this comment?\");'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <button type='submit' style='background:none; border:none; color:red; cursor:pointer;'>🗑️</button>
                </form>
            </td>
          </tr>";
}

        ?>
        </tbody>
    </table>
   
<div class="export-dropdown-container">
  <div class="export-dropdown-toggle" tabindex="0">
    Export Options ▼
  </div>
  <ul class="export-dropdown-menu">
    <li onclick="exportTableToPDF('table:nth-of-type(1)', 'Messages.pdf')">🖨️ Export Messages to PDF</li>
    <li onclick="exportTableToPDF('table:nth-of-type(2)', 'Comments.pdf')">🖨️ Export Comments to PDF</li>
    <li onclick="exportTableToCSV('messages.csv', 'table:nth-of-type(1)')">📥 Export Messages (CSV)</li>
    <li onclick="exportTableToCSV('comments.csv', 'table:nth-of-type(2)')">📥 Export Comments (CSV)</li>
  </ul>
</div>


</div>
  <form method="POST" action="admin_logout.php">
    <button type="submit" style="padding: 10px 20px; background: #c0392b; color: white; border: none; border-radius: 5px; cursor: pointer;">
        Logout
    </button><br><br><br>
</form>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

</body>
<script>
document.getElementById('dateFilter').addEventListener('change', function () {
    const selected = this.value;
    const rows = document.querySelectorAll('table:nth-of-type(2) tbody tr');
    const now = new Date();

    rows.forEach(row => {
        const dateStr = row.querySelector('td[data-label="Date"]').textContent;
        const rowDate = new Date(dateStr);
        let show = true;

        if (selected === 'today') {
            show = rowDate.toDateString() === now.toDateString();
        } else if (selected === '7days') {
            show = (now - rowDate) / (1000 * 60 * 60 * 24) <= 7;
        } else if (selected === '30days') {
            show = (now - rowDate) / (1000 * 60 * 60 * 24) <= 30;
        }

        row.style.display = (selected === 'all' || show) ? '' : 'none';
    });
});
document.getElementById('msgDateFilter').addEventListener('change', function () {
    const selected = this.value;
    const rows = document.querySelectorAll('table:nth-of-type(1) tbody tr');
    const now = new Date();

    rows.forEach(row => {
        const dateStr = row.querySelector('td[data-label="Submitted At"]').textContent;
        const rowDate = new Date(dateStr);
        let show = true;

        if (selected === 'today') {
            show = rowDate.toDateString() === now.toDateString();
        } else if (selected === '7days') {
            show = (now - rowDate) / (1000 * 60 * 60 * 24) <= 7;
        } else if (selected === '30days') {
            show = (now - rowDate) / (1000 * 60 * 60 * 24) <= 30;
        }

        row.style.display = (selected === 'all' || show) ? '' : 'none';
    });
});
function exportTableToCSV(filename, tableSelector) {
    const rows = document.querySelectorAll(`${tableSelector} tr`);
    let csv = [];

    rows.forEach(row => {
        const cols = row.querySelectorAll('td, th');
        let data = Array.from(cols).map(col => `"${col.innerText}"`).join(',');
        csv.push(data);
    });

    const csvBlob = new Blob([csv.join('\n')], { type: 'text/csv' });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(csvBlob);
    link.download = filename;
    link.click();
}
document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.querySelector('.export-dropdown-toggle');
  const menu = document.querySelector('.export-dropdown-menu');

  toggle.addEventListener('click', () => {
    menu.classList.toggle('show');
  });

  // Optional: close dropdown if clicking outside
  document.addEventListener('click', (e) => {
    if (!toggle.contains(e.target) && !menu.contains(e.target)) {
      menu.classList.remove('show');
    }
  });
});



  function generatePDF() {
    html2canvas(document.body).then(function (canvas) {
      const imgData = canvas.toDataURL("image/png");
      const pdf = new jsPDF('p', 'mm', 'a4');
      const imgProps = pdf.getImageProperties(imgData);
      const pdfWidth = pdf.internal.pageSize.getWidth();
      const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
      pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
      pdf.save("screenshot.pdf");
    });
  }
</script>


</html>
<?php $conn->close(); ?>
