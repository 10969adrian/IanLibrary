<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Anggota - Ian's Library</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        .toolbar{
    width:700px;
    margin:0 auto 20px auto;
    display:flex;
    justify-content:space-between;
}

.btn-kembali,
.btn-print{
    border:none;
    color:white;
    padding:10px 18px;
    border-radius:6px;
    text-decoration:none;
    cursor:pointer;
    font-size:14px;
}

.btn-kembali{
    background:#6c757d;
}

.btn-print{
    background:#696cff;
}

.btn-kembali:hover,
.btn-print:hover{
    opacity:.9;
}

        body{
            font-family: Arial, Helvetica, sans-serif;
            background:#f5f5f9;
            padding:40px;
        }

        .aksi{
            width:700px;
            margin:0 auto 20px auto;
            text-align:center;
        }

        .btn-print{
            background:#696cff;
            color:white;
            border:none;
            padding:10px 20px;
            border-radius:5px;
            cursor:pointer;
            font-size:14px;
        }

        .btn-print:hover{
            opacity:.9;
        }

        .kartu{
            width:700px;
            margin:auto;
            background:white;
            border:2px solid #696cff;
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 4px 15px rgba(0,0,0,.15);
        }

        .header{
    background:#696cff;
    color:white;
    padding:18px;
    font-size:26px;
    font-weight:bold;
    letter-spacing:2px;
    text-align:center;
}

        .content{
    display:flex;
    align-items:center;
    gap:20px;
    padding:30px;
}

        .foto{
            width:170px;
            flex-shrink:0;
        }

        .foto img{
    width:160px;
    height:160px;
    object-fit:cover;
    border-radius:12px;
    border:2px solid #696cff;
    box-shadow:0 3px 10px rgba(0,0,0,.15);
}

        .data{
            flex:1;
            padding-left:20px;
        }

        .nama{
            font-size:26px;
            font-weight:bold;
            margin-bottom:0px;
        }

        .id-anggota{
            font-size:13px;
            color:#696cff;
            font-weight:bold;
            margin-bottom:10px;
        }

        .item{
            margin-bottom:5px;
            font-size:13px;
        }

        .label{
            display:inline-block;
            width:100px;
            font-weight:bold;
        }

        .alamat{
            margin-top:10px;
            padding-top:10px;
        }

        .footer{
            background:#f8f8f8;
            border-top:1px solid #ddd;
            padding:12px 20px;
            font-size:12px;
            color:#666;
            text-align:center;
        }

        @media print {

    *{
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    .toolbar{
        display:none;
    }

    body{
        background:white;
        padding:0;
    }

    .kartu{
        margin:auto;
        box-shadow:none;
        border:2px solid #000;
    }

    .header{
        background:#696cff !important;
        color:white !important;
    }

    .footer{
        background:#f8f8f8 !important;
        color:#666 !important;
    }
}
    </style>
</head>
<body>

<div class="toolbar">

    <a href="<?= base_url('home') ?>" class="btn-kembali">
        Kembali
    </a>

    <button onclick="window.print()" class="btn-print">
        Cetak Kartu Anggota
    </button>

</div>

<div class="kartu">

    <div class="header justify-content-center">
        IAN'S LIBRARY
    </div>

    <div class="content">

        <div class="foto">

            <?php if(!empty($user->foto)){ ?>
                <img src="<?= base_url('sneat/assets/upload/user/'.$user->foto) ?>">
            <?php } else { ?>
                <img src="<?= base_url('sneat/assets/img/avatars/13.png') ?>">
            <?php } ?>

        </div>

        <div class="data">

            <div class="nama">
                <?= $user->nama ?>
            </div>

            <div class="id-anggota">
                <?= 'TDR'.str_pad($user->userID, 3, '0', STR_PAD_LEFT); ?>
            </div>

            <div class="item">
                <span class="label">Username</span>
                : <?= $user->username ?>
            </div>

            <div class="item">
                <span class="label">Email</span>
                : <?= $user->email ?>
            </div>

            <div class="item">
                <span class="label">No HP</span>
                : <?= $user->no_hp ?>
            </div>

            <div class="item">
                <span class="label">Role</span>
                : <?= $user->role ?>
            </div>

            <div class="item">
                <span class="label">Alamat</span>
                : <?= $user->alamat ?>
            </div>

        </div>

    </div>

    <div class="footer">
        Kartu Anggota Resmi Ian's Library
    </div>

</div>

</body>
</html>