<?php
require 'db.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Available Donors</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

  <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-red-600 mb-6">Available Donors</h2>

    <!-- Filter Form -->
    <form method="GET" class="mb-6">
      <label class="block mb-2 text-gray-700 font-medium">Filter by Blood Group:</label>
      <select name="blood_group" onchange="this.form.submit()" class="border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
        <option value="">All</option>
        <?php
        $blood_groups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        $selected = $_GET['blood_group'] ?? '';
        foreach ($blood_groups as $group) {
          $is_selected = ($selected === $group) ? 'selected' : '';
          echo "<option value=\"$group\" $is_selected>$group</option>";
        }
        ?>
      </select>
    </form>

    <!-- Donor Table -->
    <div class="overflow-x-auto">
      <table class="min-w-full border border-gray-300 text-sm text-left">
        <thead class="bg-red-500 text-white">
          <tr>
            <th class="px-4 py-3 font-semibold">Name</th>
            <th class="px-4 py-3 font-semibold">Blood Group</th>
            <th class="px-4 py-3 font-semibold">Phone</th>
            <th class="px-4 py-3 font-semibold">Location</th>
          </tr>
        </thead>
        <tbody class="bg-white text-gray-700">
          <?php
          $filter = $conn->real_escape_string($selected);
          $query = ($filter !== '') ? "SELECT * FROM donors WHERE blood_group='$filter'" : "SELECT * FROM donors ORDER BY registered_at DESC";
          $result = $conn->query($query);

          if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr class='border-b hover:bg-gray-100 transition'>
                      <td class='px-4 py-2'>" . htmlspecialchars($row['name']) . "</td>
                      <td class='px-4 py-2'>" . $row['blood_group'] . "</td>
                      <td class='px-4 py-2'>" . $row['phone'] . "</td>
                      <td class='px-4 py-2'>" . $row['location'] . "</td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan='4' class='px-4 py-4 text-center text-gray-500'>No donors found.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
