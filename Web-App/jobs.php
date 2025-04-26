<?php
require_once "settings.php";

// Check connection
if ($conn->connect_error) {
    exit("Connection failed: " . $conn->connect_error);
}

// fetch all jobs listed in the database
$result = $conn->query("SELECT * FROM JOBS");

if (!$result) {
    exit("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Available Jobs">
    <meta name="keywords" content="Jobs for hire, job ad, company information">
    <meta name="author" content="Marcus">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Available Jobs</title>
</head>

<body class="jobs" id="jobsPage">
    <?php include 'navbar.inc'; ?>
    <hr>
    <div id="main">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <section>
                    <h2><?php echo $row['title']; ?></h2>

                    <p><strong>Company's reference number:</strong> <span id="jobRef<?php echo $row['id']; ?>"><?php echo $row['ref_number']; ?></span></p>
                    <p><strong>Position title: </strong><?php echo $row['title']; ?></p>
                    <p><strong>Description: </strong><?php echo nl2br($row['description']); ?></p>
                    <p><strong>Salary range: </strong><?php echo $row['salary_range']; ?></p>
                    <p><strong>To whom a successful applicant will report to: </strong><?php echo $row['report_to']; ?></p>

                    <p><strong>Key responsibilities:</strong></p>
                    <ol>
                        <?php
                        $responsibilities = explode(". ", $row['key_responsibilities']);
                        foreach ($responsibilities as $responsibility) {
                            if (!empty(trim($responsibility))) {
                                echo "<li>" . $responsibility . "</li>";
                            }
                        }
                        ?>
                    </ol>

                    <p><strong>Skills and Experience required:</strong></p>
                    <p><strong>Essential</strong></p>
                    <ul>
                        <?php
                        $essential_skills = explode(". ", $row['essential_skills']);
                        foreach ($essential_skills as $skill) {
                            if (!empty(trim($skill))) {
                                echo "<li>" . $skill . "</li>";
                            }
                        }
                        ?>
                    </ul>
                    <p><strong>Preferable</strong></p>
                    <ul>
                        <?php
                        $preferable_skills = explode(". ", $row['preferable_skills']);
                        foreach ($preferable_skills as $skill) {
                            if (!empty(trim($skill))) {
                                echo "<li>" . $skill . "</li>";
                            }
                        }
                        ?>
                    </ul>

                    <a href="apply.php?job_ref=<?php echo $row['ref_number']; ?>" class="applyLink" job-ref="<?php echo $row['ref_number']; ?>">Apply now</a>
                </section>
                <hr>
                <?php if ($row['title'] == "Data Scientist"): ?>
                    <img id="ds" src="https://emeritus.org/in/wp-content/uploads/sites/3/2022/09/data-scientist.jpg.optimal.jpg" alt="data_scientist">
                <?php endif; ?>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No job listings found.</p>
        <?php endif; ?>
    </div>
    <aside>PXZ Institute proudly carries an Equal Opportunity culture and does not discriminate based on race, color, religion, sex, sexual orientation or disability.</aside>
    <?php include 'footer.inc'; ?>
    <?php $conn->close(); ?>
</body>
</html><script src="scripts/enhancements.js"></script>
<script src="scripts/apply.js"></script>

</html>
