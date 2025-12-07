Param(
    [int]$Port = 8000
)

Write-Host "Starting local server for directory: $PWD on port $Port"

if (Get-Command python -ErrorAction SilentlyContinue) {
    Write-Host "Using Python: starting http.server on http://localhost:$Port"
    python -m http.server $Port
} elseif (Get-Command python3 -ErrorAction SilentlyContinue) {
    Write-Host "Using Python3: starting http.server on http://localhost:$Port"
    python3 -m http.server $Port
} elseif (Get-Command npx -ErrorAction SilentlyContinue) {
    Write-Host "Using npx http-server on http://localhost:$Port"
    npx http-server -p $Port
} else {
    Write-Host "No server tool found. Install Python 3 or Node.js (which provides npx)."
    Write-Host "Manual commands you can run once installed:"
    Write-Host "  python -m http.server 8000"
    Write-Host "  npx http-server -p 8000"
    Write-Host "Or install the VS Code Live Server extension and click 'Go Live'."
}
