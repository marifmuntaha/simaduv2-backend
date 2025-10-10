@php use Carbon\Carbon; @endphp
@php($logo = Storage::disk('public')->path($institution->logo))

<html lang="id">
<body style="margin-top: -20px; margin-left: 20px; margin-right: 20px">
<table style="width: 100%; border-bottom:3px black solid">
    <tr>
        <td style="width: 30px">
            <img src="{{$logo}}" style="width: 100px" alt="logo"/>
        </td>
        <td style="text-align: center">
            <span style="font-size: 20px; font-weight: bold">YAYASAN DARUL HIKMAH MENGANTI</span><br/>
            <span
                style="font-size: 16px; font-weight: bold">{{Str::upper($institution->ladder->name .' '. $institution->name)}}</span><br/>
            <span>NSM: {{$institution->nsm}} NPSN: {{$institution->npsn}}</span><br/>
            <span style="font-size: 12px; font-weight: bold">MENGANTI - KEDUNG - JEPARA</span><br/>
            <span style="font-size: 10px; font-style: italic">Sekretariat : {{$institution->address}} Email : {{$institution->email}} Telp : {{$institution->phone}}</span><br/>
        </td>
    </tr>
</table>
<br/>
<table style="width: 100%">
    <tr>
        <td style="font-size: 16px; font-weight: bold; text-align: center">SURAT KETERANGAN PINDAH</td>
    </tr>
    <tr>
        <td style="text-align: center">Nomor : {{$letter->number}}</td>
    </tr>
</table>
<br/>
<span>Yang bertanda tangan dibawah ini Kepala {{$institution->ladder->name.' '.$institution->name}} menerangkan :</span><br/>
<br/>
<table style="margin-left: 30px">
    <tr>
        <td style="width: 150px">Nama</td>
        <td>:</td>
        <td>{{$data?->name}}</td>
    </tr>
    <tr style="vertical-align: top">
        <td>Tempat, Tanggal Lahir</td>
        <td>:</td>
        <td>{{$data?->birthdate}}</td>
    </tr>
    <tr style="vertical-align: top">
        <td>Kelas</td>
        <td>:</td>
        <td>{{$data?->level}}</td>
    </tr>
    <tr style="vertical-align: top">
        <td>NISN</td>
        <td>:</td>
        <td>{{$data?->nisn}}</td>
    </tr>
    <tr style="vertical-align: top">
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td>{{$data?->gender}}</td>
    </tr>
    <tr style="vertical-align: top">
        <td>Nama Wali</td>
        <td>:</td>
        <td>{{$data?->guardName}}</td>
    </tr>
{{--    <tr style="vertical-align: top">--}}
{{--        <td>Alamat</td>--}}
{{--        <td>:</td>--}}
{{--        <td>{{$data?->address->address}}</td>--}}
{{--    </tr>--}}
    <tr style="vertical-align: top">
        <td>Keterangan</td>
        <td>:</td>
        <td>{{$data?->description}}</td>
    </tr>
</table>
<br/>
<span>Siswa tersebut akan melanjutkan sekolah/madrasah di ...................</span>
<br/>
<span>Setelah keluar dari madrasah ini, maka yang bersangkutan tidak dapat diterima kembali menjadi siswa {{$institution->ladder->alias.'. '.$institution->name}}</span>
<br/>
<span>Demikian surat keterangan ini kami buat untuk dapat digunakan  sebagaimana mestinya.</span>
<br/>
<br/>
<br/>
<table style="width: 100%">
    <tr>
        <td style="border: 2px solid black; width: 100px; padding: 5px">
            <img src="data:image/pgn;base64, {{ $qrcode }}" alt="qrcode">
        </td>
        <td rowspan="2" style="text-align: right; vertical-align: top">
            <span>Jepara, {{Carbon::now()->translatedFormat('d F Y')}}</span>
            <br/>
            <span>Kepala Madrasah</span>
            <br/>
            <br/>
            <br/>
            <br/>
            <span>{{$headmaster->frontTitle.' '.$headmaster->name.' '.$headmaster->backTitle}}</span>
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top">
            <span style="font-size: 10px; font-style: italic">Scan untuk mengunduh surat mutasi EMIS</span>
        </td>
    </tr>
</table>
</body>
</html>
