<!DOCTYPE html>
<html>
<head>
    <title>Quote Created</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 2px 2px 12px #aaa;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            font-size: 0.9em;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Quote Created</h1>
        </div>
        <div class="content">
            <p>Dear,</p>
            <p>We are pleased to inform you that a new quote has been created for you. Here are the details:</p>
            <ul>
                <li><strong>Quote Number:</strong> <?php echo e($quoteNumber); ?></li>
                <li><strong>Date:</strong> <?php echo e($createdAt); ?></li>
            </ul>
            <p>Please review the quote and let us know if you have any questions.</p>
            <p>Thank you for choosing our services.</p>
        </div>
        <div class="footer">
            <p>&copy; <?php echo e(date('Y')); ?> Your Company. All rights reserved.</p>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\material\resources\views/emails/quote_created.blade.php ENDPATH**/ ?>