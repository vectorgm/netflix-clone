# Run this site locally (localhost)

This repository is a static HTML/CSS/JS site. There are multiple simple ways to run it on `localhost`.

Options

- PowerShell (recommended if you have Python or Node installed):

  - Run the included script (will prefer Python, falls back to `npx http-server`):

    ```powershell
    # From project root (where index.html is located)
    .\serve.ps1
    # or specify a port
    .\serve.ps1 -Port 8000
    ```

  - If you prefer to run manually:

    ```powershell
    # With Python 3
    python -m http.server 8000

    # Or with Node (no install required for the package; uses npx)
    npx http-server -p 8000

    # Or with PHP (built-in server) for PHP pages
    php -S localhost:8000
    ```

- VS Code: Install the **Live Server** extension and click the `Go Live` button (bottom-right) while the workspace is open.

After starting the server open your browser to:

```
http://localhost:8000
```

Notes

- If PowerShell prevents running the script because of execution policy, run PowerShell as Administrator and allow the script temporarily:

  ```powershell
  Set-ExecutionPolicy -Scope Process -ExecutionPolicy Bypass
  .\serve.ps1
  ```

- If you need me to also add a `package.json` with a `start` script or create a small Node server file, tell me which you'd prefer and I'll add it.
