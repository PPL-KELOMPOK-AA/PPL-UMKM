<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Unggah Proposal Proyek UMKM</title>
</head>
<body>
    <div style="max-width: 600px; margin: 20px auto;">
        <h2>Form Pengajuan Proposal UMKM</h2>

        @if(session('success'))
            <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('proposal.ajukan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="margin-bottom: 10px;">
                <label>Judul Proyek:</label><br>
                <input type="text" name="judul" value="{{ old('judul') }}" style="width: 100%;" required>
            </div>

            <div style="margin-bottom: 10px;">
                <label>Deskripsi Inovasi:</label><br>
                <textarea name="deskripsi_inovasi" rows="4" style="width: 100%;" required>{{ old('deskripsi_inovasi') }}</textarea>
            </div>

            <div style="margin-bottom: 10px;">
                <label>Target Dana Dibutuhkan (Rp):</label><br>
                <input type="number" name="dana_dibutuhkan" value="{{ old('dana_dibutuhkan') }}" style="width: 100%;" required>
            </div>

            <div style="margin-bottom: 10px;">
                <label>Dokumen Proposal (PDF/DOCX):</label><br>
                <input type="file" name="file_proposal" accept=".pdf,.docx" required>
            </div>

            <button type="submit">Ajukan Proposal</button>
        </form>
    </div>
</body>
</html>