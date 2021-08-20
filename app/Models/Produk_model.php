<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Str;

class Produk_model extends Model
{   
    public function listing()
    {
        return DB::table('produk')
                ->leftJoin('gambar', 'gambar.id_produk', '=', 'produk.id_produk')
                ->leftJoin('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
                ->select('produk.*', 'kategori.nama_kategori')
                ->selectRaw('COUNT(gambar.id_gambar) AS total_gambar')
                ->where('produk.status_produk', 'Publish')
                ->orderBy('tanggal_post', 'DESC')
                ->groupBy('id_produk')
                ->get(); 
    }

    public function listingById($id_produk)
    {
        return DB::table('produk')->where('id_produk', $id_produk)->first();
    }

    public function simpan_produk($imageName)
    {   
        $nama_produk = request()->input('nama_produk');
        $kode_produk = request()->input('kode_produk');
        $slug = Str::slug($nama_produk.' '.$kode_produk, '-');

        $data = [   
            "id_user"     => request()->session()->get('id_user'),
            "id_kategori" => request()->input('id_kategori'),
            "kode_produk" => $kode_produk,
            "nama_produk" => strtoupper($nama_produk),
            "slug_produk" => $slug,
            "keterangan"  => request()->input('keterangan'),
            "keywords"    => request()->input('keywords'),
            "harga"       => request()->input('harga'),
            "harga_beli"  => request()->input('harga_beli'),
            "harga_diskon" => request()->input('harga_diskon'),
            "tanggal_mulai_diskon" => date('Y-m-d', strtotime(request()->input('tanggal_mulai_diskon'))),
            "tanggal_akhir_diskon" => date('Y-m-d', strtotime(request()->input('tanggal_akhir_diskon'))),
            "stok_minimal"       => request()->input('stok_minimal'),
            "stok"        => request()->input('stok'),
            "gambar"      => $imageName,
            "berat"       => request()->input('berat'),
            "ukuran"      => request()->input('ukuran'),
            "status_produk" => request()->input('status_produk'),
            "tanggal_post" => date('Y-m-d H:i:s')
        ];

        DB::table('produk')->insert($data);
    }

    public function ubah_produk($id_produk, $imageName="")
    {
        $nama_produk = request()->input('nama_produk');
        $kode_produk = request()->input('kode_produk');
        $slug = Str::slug($nama_produk.' '.$kode_produk, '-');

        if($imageName != "") {
            $data = [   
                "id_user"     => request()->session()->get('id_user'),
                "id_kategori" => request()->input('id_kategori'),
                "kode_produk" => $kode_produk,
                "nama_produk" => strtoupper($nama_produk),
                "slug_produk" => $slug,
                "keterangan"  => request()->input('keterangan'),
                "keywords"    => request()->input('keywords'),
                "harga"       => request()->input('harga'),
                "harga_beli"  => request()->input('harga_beli'),
                "harga_diskon" => request()->input('harga_diskon'),
                "tanggal_mulai_diskon" => date('Y-m-d', strtotime(request()->input('tanggal_mulai_diskon'))),
                "tanggal_akhir_diskon" => date('Y-m-d', strtotime(request()->input('tanggal_akhir_diskon'))),
                "stok_minimal"       => request()->input('stok_minimal'),
                "stok"        => request()->input('stok'),
                "gambar"      => $imageName,
                "berat"       => request()->input('berat'),
                "ukuran"      => request()->input('ukuran'),
                "status_produk" => request()->input('status_produk'),
            ];

            DB::table('produk')->where('id_produk', $id_produk)->update($data);

        } else {
            $data = [   
                "id_user"     => request()->session()->get('id_user'),
                "id_kategori" => request()->input('id_kategori'),
                "kode_produk" => $kode_produk,
                "nama_produk" => strtoupper($nama_produk),
                "slug_produk" => $slug,
                "keterangan"  => request()->input('keterangan'),
                "keywords"    => request()->input('keywords'),
                "harga"       => request()->input('harga'),
                "harga_beli"  => request()->input('harga_beli'),
                "harga_diskon" => request()->input('harga_diskon'),
                "tanggal_mulai_diskon" => date('Y-m-d', strtotime(request()->input('tanggal_mulai_diskon'))),
                "tanggal_akhir_diskon" => date('Y-m-d', strtotime(request()->input('tanggal_akhir_diskon'))),
                "stok_minimal"       => request()->input('stok_minimal'),
                "stok"        => request()->input('stok'),
                "berat"       => request()->input('berat'),
                "ukuran"      => request()->input('ukuran'),
                "status_produk" => request()->input('status_produk'),
            ];

            DB::table('produk')->where('id_produk', $id_produk)->update($data);
        }

        
    }

    public function hapus_produk($id_produk)
    {
        DB::table('produk')->where('id_produk', $id_produk)->delete();
    }

    public function gambarDetail($id_produk)
    {
        return DB::table('gambar')->where('id_produk', $id_produk)->get();
    }

    public function gambarById($id_gambar)
    {
        return DB::table('gambar')->where('id_gambar', $id_gambar)->first();
    }

    public function hapus_gambar($id_gambar)
    {
        DB::table('gambar')->where('id_gambar', $id_gambar)->delete();
    }

    public function tambah_gambar($imageName)
    {
        $data = [
            "id_produk" => request()->input('id_produk'),
            "judul_gambar" => strtoupper(request()->input('judul_gambar')),
            "gambar" => $imageName
        ];

        DB::table('gambar')->insert($data);
    }

    // frontend
    public function home()
    {
        return DB::table('produk')
                    ->where('harga_diskon', '>', '0')
                    ->where('tanggal_mulai_diskon', '<=', date('Y-m-d'))
                    ->where('tanggal_akhir_diskon', '>=', date('Y-m-d'))
                    ->groupBy('produk.id_produk')
                    ->limit(20)
                    ->get();
    }

    public function semua_produk()
    {
        return DB::table('produk')
                    ->where('status_produk', 'Publish')
                    ->orderBy('tanggal_post', 'DESC')
                    ->paginate(9);
    }

    public function sub_produk($type)
    {
        return DB::table('produk')
                    ->where('status_produk', 'Publish')
                    ->where('kode_produk', 'LIKE', $type.'%')
                    ->orderBy('tanggal_post', 'DESC')
                    ->paginate(9);
    }

    public function kategori($id_kategori)
    {
        return DB::table('produk')
                    ->where('status_produk', 'Publish')
                    ->where('id_kategori', $id_kategori)
                    ->orderBy('tanggal_post', 'DESC')
                    ->paginate(9);
    }
    
    public function listingBySlug($slug_produk)
    {
        return DB::table('produk')->where('slug_produk', $slug_produk)->first();
    }

    // autocomplete
    public function cari_produk($keyword)
    {
        return DB::table('produk')
                    ->where('nama_produk', 'LIKE', '%'.$keyword.'%')
                    ->limit(6)
                    ->get(['nama_produk', 'slug_produk', 'gambar']);
    }


    
}
