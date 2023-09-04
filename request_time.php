<?php

mail('devsonspree@gmail.com', 'My Subject', 'Hi');
if (!$success) {
  $errorMessage = error_get_last()['message'];
} else {
  echo "1";
}

?>