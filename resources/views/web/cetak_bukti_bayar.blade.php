<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <center>
        <div class="card m-5" style="width: 500px">
            <div class="card-body p-2">
                <center>
                    <span class="text-center">
                        <img src="{{ asset('img/logo.png') }}" alt="" width="50px"> <br>
                        www.oluhutajourney.com
                    </span>
                </center>
                <table class="w-100 mt-5">
                    <tr>
                        <td>
                            Nomor Order
                        </td>
                        <td>:</td>
                        <td>
                            <b>
                                {{ $data->order_id }}
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>
                            {{ $data->user->name }}
                        </td>
                    </tr>
                    <tr>
                        <td>Layanan/Produk</td>
                        <td>:</td>
                        <td>
                            {{ $data->product->product }}
                        </td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td>
                            Rp. {{ number_format($data->product->harga, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            {{ $data->status = 'capture' ? 'Lunas' : 'Belum Lunas' }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Tanggal Buat
                        </td>
                        <td>:</td>
                        <td>
                            {{ $data->created_at }}
                        </td>
                    </tr>
                </table>
                <center>
                    <br><br><br>
                    == Terima Kasih ==
                </center>
            </div>
        </div>
    </center>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script>
        window.print()
    </script>
</body>

</html>
