<html>
<head>
	<meta charset="utf-8">
	<title>Create Profile Form</title>
	<link rel="stylesheet" media="screen" href="styles.css">
</head>



<body>

<form class="contact_form" action="createPro.php" method="post" name="contact_form">
<ul>
        <li>
             <h2>Create Profile</h2>
             <span class="required_notification">* Denotes Required Field</span>
        </li>
        <li>
            <label for="name">Name:</label>
            <input type="text" name="Name" placeholder="Siddharth" required />
        </li>
        <li>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="sidd@sid.contact_form" required />
            <span class="form_hint">Proper format "name@something.com"</span>
        </li>
        <li>
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="sidd123" />
            <span class="form_hint">Proper format siddnitr1"</span>
        </li>
        <li>
            <label for="passsword">Password:</label>
            <input type="text" name="password" placeholder="7n67u85nhj" />
            <span class="form_hint">Proper format 7n67u85nhj"</span>
        </li>
        <li>
            <label for="message">Message:</label>
            <textarea name="message" cols="40" rows="6" required ></textarea>
        </li>
        <li>
        	<button class="submit" type="submit">Submit Form</button>
        </li>
    </ul>




</body>
</html>