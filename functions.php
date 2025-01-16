<?php
// form validation

// check if logged in
function checkLoggedIn(): bool
{
    if (isset($_SESSION['first_name'])) {
        return true;
    } else {
        return false;
    }
}