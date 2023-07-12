<!DOCTYPE html>
<html>
<head>
    <title>Study Tracker - Add Subject</title>
</head>
<body>
    <h1>Add Subject</h1>

    <form method="post" action="/subjects/save">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="hours_studied">Hours Studied:</label>
        <input type="number" id="hours_studied" name="hours_studied" required>

        <button type="submit">Save</button>
    </form>
</body>
</html>
