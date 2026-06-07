$root   = "D:\Projects\BGA\Eole"
$FOGRA39  = ".\FOGRA39.icc" 
$srgb   = ".\sRGB Color Space Profile.icm"
$clutFile = ".\EOLE_grade_clut.png"

Get-ChildItem -Path $root -Filter "*.jpg" -Recurse -File | ForEach-Object {
    $fname  = $_.FullName

    magick $fname -profile $FOGRA39 -intent Relative -black-point-compensation -profile $srgb $clutFile -clut  $fname
    Write-Host "OK: $fname"
}