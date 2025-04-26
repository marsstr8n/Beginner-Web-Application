<?php
require_once "settings.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the job table if it doesn't exist
$createJobTableSql = "CREATE TABLE IF NOT EXISTS JOBS (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ref_number VARCHAR(5) UNIQUE,
    title VARCHAR(50),
    description TEXT,
    salary_range VARCHAR(50),
    report_to VARCHAR(50),
    key_responsibilities TEXT,
    essential_skills TEXT,
    preferable_skills TEXT
);";

if (!$conn->query($createJobTableSql)) {
    exit("Failed to create table: " . $conn->error);
}

// Function to check if a job exists
function jobExists($conn, $ref_number) {
    $stmt = $conn->prepare("SELECT ref_number FROM JOBS WHERE ref_number = ?");
    if (!$stmt) {
        exit("Prepare statement failed: " . $conn->error);
    }
    $stmt->bind_param("s", $ref_number);
    $stmt->execute();
    $stmt->store_result();
    $exists = $stmt->num_rows > 0;
    $stmt->close();
    return $exists;
}

// Prepare and bind the insert statement
$stmt = $conn->prepare("INSERT INTO JOBS (ref_number, title, description, salary_range, report_to, key_responsibilities, essential_skills, preferable_skills) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    exit("Prepare statement failed: " . $conn->error);
}
$stmt->bind_param("ssssssss", $ref_number, $title, $description, $salary_range, $report_to, $key_responsibilities, $essential_skills, $preferable_skills);

// First job: Usability Specialist
$ref_number = "XZ457";
$title = "Usability Specialist";
$description = "In our company, the UX tester will act as the bridge connecting between users and the product development. 
Your role is to conduct usability tests, gather user feedback, present the findings to the development team 
as well as shareholders.";
$salary_range = "AU$61k-AU$102k";
$report_to = "Senior UX designer";
$key_responsibilities = "Design, conduct and report your findings about usability tests, based on the project aims. Recruit testing participants, responsible for facilitating a diverse and unbiased sample. Conduct various usability tests, including but not limited to, quantitative testing (e.g., A/B testing, surveys) and qualitative testing (e.g., session recordings, unmoderated usability tests). Analyse and interpret the quantitative and qualitative data. Identify issues and possible solutions with the Senior designer. Create detailed reports and present the findings to upper management, and propose solutions.";
$essential_skills = "Bachelor's degree in Computer Science, Psychology, or a related field. 2+ years working as a UX tester or an equivalent occupation. Experienced in conducting usability testings, and have a deep understand of the steps in the process. Experienced in using different toolkits for UX testing. Strong communication skill, having an ability to describe accurately and concisely, to both technical and nontechnical audience. Comfortable working in a team environment, and handle multiple projects at once.";
$preferable_skills = "Can take initiative, confident in handling difficult situations. Have a general knowledge about programming languages related to our prototypes, such as HTML, or CSS. Confident in public speaking, can engage listeners into collaborative discussions.";

if (!jobExists($conn, $ref_number)) {
    if ($stmt->execute()) {
        echo "<p>Job 'Usability Specialist' added successfully</p>";
    } else {
        echo "<p>Failed to add job: " . $stmt->error . "</p>";
    }
} else {
    echo "<p>Job 'Usability Specialist' already exists</p>"; // prevent duplicate entries
}

// Second job: Data Scientist
$ref_number = "DSV07";
$title = "Data Scientist";
$description = "As a data scientist, your role is to utilise existing database, machine learning and statistical techniques to improve on business-making decisions. Your role is to collaborate with our data team, develop statistical models, and convert your finding into actionable goals to contribute to the company's success.";
$salary_range = "AU$70k-AU$100k";
$report_to = "Director of Data Science";
$key_responsibilities = "Communicate with stakeholders to understand their goal and requirements from a project. Clean, process data to ensure they are ready for analysis. Perform data analysis to figure out trends, patterns and derive insights that are executable in terms of business decisions. Present the data to stakeholders, communicate effectively to both technical and nontechnical audience, with the use of data visualisation. Develop machine learning models to aid our business in problem solving. Keep up-to-date with the latest Data Science technology, implement the new discovery to improve on our company's analytical models.";
$essential_skills = "Bachelor's degree or Master in Computer Science, Data Science, Engineering, or a related field. Proven ability in data analysis, machine learning techniques. Experienced in utilising Python libraries (numpy, matplotlib, pandas, seaborn). Experienced in working with big data tools (SQL, Spark). Strong communication skill, having an ability to describe accurately and concisely, to both technical and nontechnical audience. Comfortable working in a team environment or independent, in a strict time period.";
$preferable_skills = "Can take initiative, confident in handling difficult situations. Confident in public speaking, can engage listeners into collaborative discussions.";

if (!jobExists($conn, $ref_number)) {
    if ($stmt->execute()) {
        echo "<p>Job 'Junior Data Scientist' added successfully</p>";
    } else {
        echo "<p>Failed to add job: " . $stmt->error . "</p>";
    }
} else {
    echo "<p>Job 'Junior Data Scientist' already exists</p>"; // prevent duplicate entries
}

$stmt->close();
$conn->close();
?>
