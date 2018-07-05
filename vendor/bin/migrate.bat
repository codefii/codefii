@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../byjg/migration/scripts/migrate
php "%BIN_TARGET%" %*
