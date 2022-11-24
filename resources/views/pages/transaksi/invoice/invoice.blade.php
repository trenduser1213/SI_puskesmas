<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        table, td, th {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
    </style>
</head>
<body>
    <section>
        <div style="text-align: center">
            <h3><strong>FAKTUR PEMERIKSAAN</strong></h3>
        </div>
        <div>
            <table>
                
                    <th>
                        <tr>
                            <td>No</td>
                            <td>Nama Obat</td>
                            <td>Kategori Obat</td>
                            <td>Jumlah Obat</td>
                            <td>Keterangan Obat</td>
                            <td>Harga Obat (Rp.)</td>
                            <td>Subtotal (Rp.)</td>
                        </tr>
                    </th>

                    @php
                        $no=1;
                    @endphp
                    @foreach ($resepObat as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->obat->nama}}</td>
                            <td>{{$item->obat->kategori_obat->nama}}</td>
                            <td>{{$item->jumlah_obat}}</td>
                            <td>{{$item->keterangan_obat}}</td>
                            <td> {{ number_format($item->obat->harga, 0, ',', '.') }}</td>
                            <td>{{ number_format((int)$item->obat->harga * (int)$item->jumlah_obat, 0, ',', '.') }} </td>

                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="5" style="border-bottom: 1px solid white" ></th>
                            <th colspan="1" style="text-align: left">Total (Rp.)</th>
                            <td colspan="1"><strong>{{ number_format($total, 0, ',', '.') }}</strong></td>
                        </tr>
                        <tr>
                            <th colspan="5" style="text-align: left;border-bottom: 1px solid white" ></th>
                            <th colspan="1" style="text-align: left">Jasa Dokter (Rp.)</th>
                            <td colspan="1"><strong>{{ number_format($transaksi->jasa_dokter, 0, ',', '.') }}</strong></td>
                        </tr>
                        <tr>
                            <th colspan="5" style="text-align: left" ></th>
                            <th colspan="1" style="text-align: left">Grand Total (Rp.)</th>
                            <td colspan="1"><strong>{{ number_format($transaksi->total, 0, ',', '.') }}</strong></td>
                        </tr>
               
            </table>
        </div>
    </section>
</body>
</html>