@extends('base')
@section('title','Edit Pegawai')
@section('menupegawai', 'underline decoration-4 underline-offset-7')
@section('content')
    <section class="p-4 bg-white rounded-lg min-h-[50vh]">
        <h1 class="text-3xl font-bold text-[#C0392B] mb-6 text-center">Edit Pegawai</h1>
        <div class="mx-auto max-w-screen-xl">
            {{-- Error Validation --}}
            @if($errors->any())
                <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-700 border border-red-300">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pegawai.update', ['id' => $data->id]) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $data->nama) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $data->email) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                    <select name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                        <option value="">Pilih Gender</option>
                        <option value="male" {{ old('gender', $data->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="female" {{ old('gender', $data->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                    <select name="pekerjaan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                        <option value="">Pilih Pekerjaan</option>
                        @foreach($pekerjaan as $p)
                            <option value="{{ $p->id }}" {{ old('pekerjaan_id', $data->pekerjaan_id) == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="is_active" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                        <option value="1" {{ old('is_active', $data->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('is_active', $data->is_active) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2">
                    <a href="{{ route('pegawai.index') }}" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Kembali</a>
                    <button type="submit" class="rounded-md bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700 cursor-pointer">Simpan</button>
                </div>
            </form>
        </div>
    </section>
@endsection
