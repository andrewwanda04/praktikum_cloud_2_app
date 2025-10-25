<!DOCTYPE html>
<html>
<head>
    <title>Calculator App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container text-center mt-5">
        <h1 class="mb-4">🧮 Calculator App</h1>
        <form method="POST" action="{{ route('calculate') }}" class="card p-4 shadow-sm mx-auto" style="max-width: 400px;">
            @csrf
            <div class="mb-3">
                <input type="number" step="any" name="num1" class="form-control" placeholder="Angka pertama" value="{{ $num1 ?? '' }}" required>
            </div>
            <div class="mb-3">
                <select name="operation" class="form-select" required>
                    <option value="+" {{ (isset($operation) && $operation == '+') ? 'selected' : '' }}>+</option>
                    <option value="-" {{ (isset($operation) && $operation == '-') ? 'selected' : '' }}>-</option>
                    <option value="*" {{ (isset($operation) && $operation == '*') ? 'selected' : '' }}>*</option>
                    <option value="/" {{ (isset($operation) && $operation == '/') ? 'selected' : '' }}>/</option>
                </select>
            </div>
            <div class="mb-3">
                <input type="number" step="any" name="num2" class="form-control" placeholder="Angka kedua" value="{{ $num2 ?? '' }}" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Hitung</button>

            @if(isset($result))
                <div class="alert alert-success mt-4">
                    <strong>Hasil:</strong> {{ $result }}
                </div>
            @endif
        </form>
    </div>
</body>
</html>
