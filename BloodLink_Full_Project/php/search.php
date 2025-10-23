<?php
require 'db.php';

if (isset($_GET['blood_group']) && isset($_GET['location'])) {
    $blood_group = $conn->real_escape_string($_GET['blood_group']);
    $location = $conn->real_escape_string($_GET['location']);

    $sql = "SELECT * FROM donors WHERE blood_group = '$blood_group' AND location LIKE '%$location%'";
    $result = $conn->query($sql);
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Search Results</title>
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100 p-6">
      <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold text-red-600 mb-6">Matching Donors</h2>

        <div class="overflow-x-auto">
          <table class="min-w-full border border-gray-300 text-sm text-left">
            <thead class="bg-red-500 text-white">
              <tr>
                <th class="py-3 px-4 font-semibold">Name</th>
                <th class="py-3 px-4 font-semibold">Blood Group</th>
                <th class="py-3 px-4 font-semibold">Location</th>
                <th class="py-3 px-4 font-semibold">Phone</th>
              </tr>
            </thead>
            <tbody class="bg-white text-gray-700">
              <?php
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr class='border-b hover:bg-gray-100 transition'>
                              <td class='py-2 px-4'>" . htmlspecialchars($row['name']) . "</td>
                              <td class='py-2 px-4'>" . $row['blood_group'] . "</td>
                              <td class='py-2 px-4'>" . $row['location'] . "</td>
                              <td class='py-2 px-4'>" . $row['phone'] . "</td>
                            </tr>";
                  }
              } else {
                  echo "<tr><td colspan='4' class='py-4 px-4 text-center text-gray-500'>No matching donors found.</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </body>
    </html>

    <?php
}
?>
