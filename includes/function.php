<?php
// Function to generate a CSRF token
function generateCsrfToken()
{
    return bin2hex(random_bytes(32));
}
