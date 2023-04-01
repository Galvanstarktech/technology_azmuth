<?php
$dir = './'; // path to current directory
$files = scandir($dir); // scan the directory for all files
$success = true; // assume success
foreach ($files as $file) {
    if (is_file($dir . $file) && pathinfo($dir . $file, PATHINFO_EXTENSION) == 'pdf') {
        // check if the item is a PDF file
        // Check if the file name contains ##_ prefix
        if (preg_match('/\b##_/i', $file)) {
            // Remove the prefix from the file name
            $newname = preg_replace('/^\w+_##_/', '', $file);
            // Remove underscores from the new file name
            $newname = str_replace('_', '', $newname);
            // Rename the file
            if (!rename($dir . $file, $dir . $newname)) {
                $success = false; // rename failed
            }
        }
    }
}
if ($success) {
    echo "All PDF files renamed successfully.";
} else {
    echo "Failed to rename all PDF files.";
}
?>
