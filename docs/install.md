# Install

Read all the points before proceeding to be sure you have all info in your head😄.

1. Create your account on [BGA Studio](https://studio.boardgamearena.com/). You'll receive an email with credentials to use to connect to your SFTP storage directory
2. Create a new project on BGA Studio. Note: You can't call it altered/Altered, the name is reserved for the production game. You can call it whatever else you like, e.g. <yourname>altered e.g. `jsmithaltered`.
3. Open VSCode (or whatever IDE you're using) and instantiate the SFTP connection (read "File Sync" section of [this wiki page](https://en.doc.boardgamearena.com/Setting_up_BGA_Development_environment_using_VSCode))
4. Pull the code from the [Altered-Community github repo](https://github.com/Altered-Community/bga-altered)
5. Replace in the shell or powershell file provided below  `YOUR_PROJECT_NAME_IN_BGA_STUDIO` by the name of your project in BGA Studio and `YOUR_PATH_HERE/community_bga_altered` & `YOUR_PATH_HERE/your_project_name` by the appropriate paths
6. Run the command file provided
7. ⚠️ This step is tricky: <br>
 delete EVERYTHING on your project's SFTP folder (having some original files in the project mixed up with the updated ones just throw up entirely the state machine. So this might not be necessary, but it was for at least 2 people)
8. Verify that the rename worked (you won't be able to see every changes, but at the very least you can confirm that the files in the root of your own project have been rename to match the directory name: for me, the project's name is nylaltered, so I should have nylaltered.action.php, nylaltered.css, nylaltered.game.php...) 
9. Upload the newly copied files to the now empty project directory on the SFTP (use `Ctrl+Shift+P` on code and `SFTP: Upload Project`)
10. You can download from your BGA SFTP folder this file `_ide_helper.php`; it will help your IDE to recognize the classes from the BGA framework.
11. Go to your dashboard on BGA Studio, click Manage Game, find your project and open it, click "Play" on the menu near the box sample, create a new table, then Express Start. This should open a new window where you can select the deck for the first player.  Once done, click on the red ">"  next to the player name to do the same with the second player

shell file: 
```sh
#!/bin/bash

SOURCE_PATH="YOUR_PATH_HERE/community_bga_altered"
DEST_PATH="YOUR_PATH_HERE/your_project_name"

EXCLUDES=(".git" ".vscode" "misc")

# Build the exclude arguments for cp
EXCLUDE_ARGS=()
for dir in "${EXCLUDES[@]}"; do
    EXCLUDE_ARGS+=(--exclude="$dir")
done

# Copy everything except excluded dirs (mirrors the PowerShell logic)
rsync -a "${EXCLUDE_ARGS[@]}" "$SOURCE_PATH/" "$DEST_PATH/"

# Rename files containing 'altered' in their name (php, js, css, tpl)
find "$DEST_PATH" -type f \( -name "*.php" -o -name "*.js" -o -name "*.css" -o -name "*.tpl" \) | \
while IFS= read -r file; do
    dir=$(dirname "$file")
    base=$(basename "$file")

    # Rename the file if its name contains 'altered'
    if [[ "$base" == *altered* ]]; then
        newname="${base//altered/YOUR_PROJECT_NAME_IN_BGA_STUDIO}"
        mv "$file" "$dir/$newname"
        file="$dir/$newname"
    fi

    # Replace 'altered' with 'nylaltered' inside the file content
    sed -i '' "s/altered/YOUR_PROJECT_NAME_IN_BGA_STUDIO/g" "$file"  2>/dev/null || \
    sed -i    "s/altered/YOUR_PROJECT_NAME_IN_BGA_STUDIO/g" "$file"
done

echo "Done! Press Enter to exit."
read -r
```
Powershell file:
```powershell
$filePath = "D:\YOUR_PATH_HERE\community_bga_altered"
$tempPath = "D:\YOUR_PATH_HERE\your_project_name"
$include = @('*.php', '*.js') # adapt as needed

$excludes = @(".git",".vscode", "misc")


Get-ChildItem $filePath -Directory | 
    Where-Object{$_.Name -notin $excludes} | 
    Copy-Item -Destination $tempPath -Recurse -Force

Get-ChildItem $filePath -file | 
    Copy-Item -Destination $tempPath -Force


Get-ChildItem -File -Recurse $tempPath |
    Where-Object{ $_.Extension -in @('.php', '.js', '.css', '.tpl') } |
  Rename-Item -PassThru -Force -NewName { $_.Name -replace 'altered', 'YOUR_PROJECT_NAME_IN_BGA_STUDIO' } |
  ForEach-Object {
#     # NOTE: You may have to use an -Encoding argument here to ensure
#     #       the desired character encoding.
    ($_ | Get-Content -Raw) -replace 'altered', 'YOUR_PROJECT_NAME_IN_BGA_STUDIO' |
      Set-Content -NoNewLine -LiteralPath $_.FullName
 }
Read-Host "pause"
```

## BGA starting Resources
- https://en.doc.boardgamearena.com/First_steps_with_BGA_Studio
- https://en.doc.boardgamearena.com/Setting_up_BGA_Development_environment_using_VSCode
- https://en.doc.boardgamearena.com/Tools_and_tips_of_BGA_Studio

## Navigation
[< Back to Getting started](getting_started.md)

[< Back to main](../README.md)
