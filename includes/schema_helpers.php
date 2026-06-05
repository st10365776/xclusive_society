<?php

function ensureColumn(mysqli $conn, string $table, string $column, string $definition): void
{
    $safeTable = preg_replace('/[^A-Za-z0-9_]/', '', $table);
    $safeColumn = preg_replace('/[^A-Za-z0-9_]/', '', $column);

    $columnCheck = $conn->query("SHOW COLUMNS FROM $safeTable LIKE '$safeColumn'");

    if ($columnCheck && $columnCheck->num_rows === 0) {
        $conn->query("ALTER TABLE $safeTable ADD $safeColumn $definition");
    }
}

function ensureStoreSchema(mysqli $conn): void
{
    ensureColumn($conn, 'tblClothes', 'description', 'TEXT DEFAULT NULL AFTER category');
    ensureColumn($conn, 'tblClothes', 'isActive', 'BOOLEAN DEFAULT TRUE');
    ensureColumn($conn, 'tblClothes', 'displayOrder', 'INT DEFAULT 0');
    ensureColumn($conn, 'tblClothes', 'quantity', 'INT NOT NULL DEFAULT 10');

    ensureColumn($conn, 'tblAorder', 'shippingAddress', 'VARCHAR(255) DEFAULT NULL');
    ensureColumn($conn, 'tblAorder', 'shippingMethod', 'VARCHAR(80) DEFAULT NULL');
    ensureColumn($conn, 'tblAorder', 'paymentMethod', 'VARCHAR(80) DEFAULT NULL');
    ensureColumn($conn, 'tblAorder', 'paymentLast4', 'VARCHAR(4) DEFAULT NULL');
}

?>
