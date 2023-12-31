<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use getID3;

class SongSeeder extends Seeder
{
    public function run(): void
    {
        $songs = File::files(public_path('music'));
        $genreImg = [
            'nhạc trẻ' => 'https://i.postimg.cc/C5v1dMM1/image.png',
            'edm, remix' => 'https://i.postimg.cc/zGPrTcqj/image.png',
            'rap việt' => 'https://i.postimg.cc/R0DJm7JX/image.png',
            'rock việt' => 'https://i.postimg.cc/J0CM80rs/image.png',
            'trữ tình' => 'https://i.postimg.cc/c15tsTvc/nhac-tru-tinh-tieng-anh-la-gi.jpg',
            'nhạc trịnh' => 'https://i.postimg.cc/FK3sQg2D/image.png',
            'pop' => 'https://i.postimg.cc/RV8qwF95/image.png',
            'nhạc cách mạng' => 'https://i.postimg.cc/02S8SCNx/image.png',
            'tiền chiến' => 'https://i.postimg.cc/yx41dfZD/image.png',
        ];
        $artistImg = [
            'đinh tùng huy' => 'https://i.postimg.cc/yxjdWMCL/th.jpg',
            'tiên tiên' =>'https://i.postimg.cc/yN9rj7FD/image.png',
            'touliver' =>'https://i.postimg.cc/TPqJh1VJ/image.png',
            'acv' => 'https://i.postimg.cc/HkBh3BdF/th.jpg',
            'junky' => 'https://i.postimg.cc/t4whXx5Y/th.jpg',
            'trung ngon' => 'https://i.postimg.cc/TYHb9DBC/th.jpg',
            "tú na" => 'https://i.postimg.cc/W4cwGZJx/th.jpg',
            "thương võ" => 'https://i.postimg.cc/90kGrwh8/th.jpg',
            "sơn tùng (m-tp)" => 'https://i.postimg.cc/rpT50LBk/th.jpg',
            "như việt"    => 'https://i.postimg.cc/MpmmYTbT/th.jpg',
            "vũ duy khánh"    => 'https://i.postimg.cc/76f1DNvG/th.jpg',
            "đạt g"    => 'https://i.postimg.cc/t44N2brN/th.jpg',
            "hà nhi"    => 'https://i.postimg.cc/JhycCqCy/th.jpg',
            "emcee l" => 'https://i.postimg.cc/wvXN94fB/th.jpg',
            "dee trần"    => 'https://i.postimg.cc/xC2kpyfV/th.jpg',
            "lương bích hữu"   => 'https://i.postimg.cc/zDdBT1gr/th.jpg',
            "lệ quyên"    => 'https://i.postimg.cc/CLBFDn0G/th.jpg',
            "tăng phúc"    => 'https://i.postimg.cc/bw0fHQBt/th.jpg',
            "hà anh tuấn"    => 'https://i.postimg.cc/9Q2QhF3y/th.jpg',
            "phương linh"    => 'https://i.postimg.cc/qqn4PWjm/th.jpg',
            "mr.siro"    => 'https://i.postimg.cc/6pBtPjR0/th.jpg',
            "khang việt"    => 'https://i.postimg.cc/nV7xhbG2/th.jpg',
            "hana cẩm tiên"    => 'https://i.postimg.cc/rs2vrsNJ/th.jpg',
            "châu khải phong"  => 'https://i.postimg.cc/W41jN527/th.jpg',
            "h-kray"    => 'https://i.postimg.cc/VvBHbcg0/th.jpg',
            "freak d"    => 'https://i.postimg.cc/44b8Psvm/th.jpg',
            "khả hiệp"    => 'https://i.postimg.cc/jd2zfbMV/th.jpg',
            "phương đặng"    => 'https://i.postimg.cc/gcQ0MbYb/th.jpg',
            "lam trường"   => 'https://i.postimg.cc/q7Dt4hdz/th.jpg',
            "quân a.p"    => 'https://i.postimg.cc/dtQKmWCc/th.jpg',
            "piz"     => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "đinh kiến phong"      => 'https://i.postimg.cc/sD0gNB5X/th.jpg',
            "huy kun" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "noo phước thịnh"  => 'https://i.postimg.cc/c1tWLD3s/th.jpg',
            "vương anh tú"    => 'https://i.postimg.cc/jdYpdRKX/th.jpg',
            "chu bin"  => 'https://i.postimg.cc/LXfxrZqM/th.jpg',
            "thái hòa" => 'https://i.postimg.cc/k4cb6nzb/th.jpg',
            "phượng linh"  => 'https://i.postimg.cc/qqn4PWjm/th.jpg',
            "o.lew (việt nam)" => 'https://i.postimg.cc/dtpcPG3h/image.png',
            "đình dũng"    => 'https://i.postimg.cc/N0PzmcX5/th.jpg',
            "nhật phong"   => 'https://i.postimg.cc/mkZ1s0dy/th.jpg',
            "nguyễn hồng ân"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "billy shane" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "duy quang"        => 'https://i.postimg.cc/qqMR62Hs/th.jpg',
            "ngọc lan"        => 'https://i.postimg.cc/zvms9r0V/th.jpg',
            "giang hồng ngọc"  => 'https://i.postimg.cc/JnCK8zCV/th.jpg',
            "thanh tuyền"    => 'https://i.postimg.cc/cJS84gCm/th.jpg',
            "hạ vy"    => 'https://i.postimg.cc/9M44LGnc/th.jpg',
            "quang lê" => 'https://i.postimg.cc/66YSrCN8/th.jpg',
            "phong thái phương"    => 'https://i.postimg.cc/C1drMLcc/th.jpg',
            "cao hoàng nghi"   => 'https://i.postimg.cc/hv1dHVV6/th.jpg',
            "phú cường"    => 'https://i.postimg.cc/76DPjdXP/th.jpg',
            "changg saa"   => 'https://i.postimg.cc/xCF7Lbkr/th.jpg',
            "thu đặng"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "nam đức"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "li li"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "lê cát trọng lý"  => 'https://i.postimg.cc/5ymMLtM8/th.jpg',
            "doãn hiếu"    => 'https://i.postimg.cc/sXwcWFNv/th.jpg',
            "minh chi"    => 'https://i.postimg.cc/3wbjrj4v/th.jpg',
            "thu hiền"    => 'https://i.postimg.cc/PJMPJh3R/th.jpg',
            "khánh hà"    => 'https://i.postimg.cc/g0PFSRk3/th.jpg',
            "long nhật"    => 'https://i.postimg.cc/T3cMs1yS/th.jpg',
            "như quỳnh"    => 'https://i.postimg.cc/8zXwsgxc/th.jpg',
            "nguyên tuân" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "quang dũng" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "quang thọ"    => 'https://i.postimg.cc/XNDv2HMF/th.jpg',
            "minh đinh"    => 'https://i.postimg.cc/vHfccrjV/th.jpg',
            "tạ minh tâm"  => 'https://i.postimg.cc/TY0v7h5s/th.jpg',
            "nguyễn khánh ly"  => 'https://i.postimg.cc/8P5ZGCn9/th.jpg',
            "tâm đoan"    => 'https://i.postimg.cc/HkLn3qnQ/th.jpg',
            "vũ hoàng"    => 'https://i.postimg.cc/XJg6RvDX/th.jpg',
            "thạch thảo"   => 'https://i.postimg.cc/k5ncjX8T/th.jpg',
            "trường vũ"    => 'https://i.postimg.cc/jqNMd9sQ/th.jpg',
            "lê bảo bình"  => 'https://i.postimg.cc/xCLLYwKX/th.jpg',
            "tân nhàn" => 'https://i.postimg.cc/0Q592mS7/th.jpg',
            "đinh quốc anh"    => 'https://i.postimg.cc/zBf11Nmj/th.jpg',
            "doãn tần (nsưt)"  => 'https://i.postimg.cc/J48C1jW0/th.jpg',
            "suzie nguyễn"    => 'https://i.postimg.cc/593nCzC6/th.jpg',
            "dr.a" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "dzung"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "onlyc"    => 'https://i.postimg.cc/GpgsRc83/th.jpg',
            "htrol" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "ygaria" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "mai khôi" => 'https://i.postimg.cc/PxdVgQDn/th.jpg',
            "lô thủy"  => 'https://i.postimg.cc/Xqm8YfrJ/th.jpg',
            "du uyên"  => 'https://i.postimg.cc/HLz9yDrF/th.jpg',
            "hồ hoàng yến" => 'https://i.postimg.cc/d1Xd2qwN/th.jpg',
            "dương hồng loan"  => 'https://i.postimg.cc/bN11PKjX/th.jpg',
            "lâm bảo phi"  => 'https://i.postimg.cc/xCbcRzfr/th.jpg',
            "yuni boo" => 'https://i.postimg.cc/9MTQTHbC/th.jpg',
            "goctoi mixer" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "huỳnh văn"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "mtv band" => 'https://i.postimg.cc/1zQCPpdB/th.jpg',
            "khánh phong"  => 'https://i.postimg.cc/g02MnYYL/th.jpg',
            "dj future"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "ngọc dolil"   => 'https://i.postimg.cc/rwFG9Q7v/th.jpg',
            "đinh quốc cường"  => 'https://i.postimg.cc/pVfDbwHw/th.jpg',
            "cẩm ly"   => 'https://i.postimg.cc/HnnHzG4r/th.jpg',
            "randy"    => 'https://i.postimg.cc/Gh2q31n5/th.jpg',
            "lâm thúy vân" => 'https://i.postimg.cc/8kym0nfB/th.jpg',
            "đan nguyên"   => 'https://i.postimg.cc/XY5KXjHQ/th.jpg',
            "huỳnh nguyễn công bằng"   => 'https://i.postimg.cc/85zrdN48/th.jpg',
            "giao linh"    => 'https://i.postimg.cc/nLRqPXCV/th.jpg',
            "nhật tinh anh"    => 'https://i.postimg.cc/TYMgFMYb/th.jpg',
            "minh vương m4u"   => 'https://i.postimg.cc/y8nRDDhh/th.jpg',
            "việt"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "đức tuấn"   => 'https://i.postimg.cc/jSCxhC04/th.jpg',
            "cá hồi hoang" => 'https://i.postimg.cc/g25YtdGF/th.jpg',
            "hồng mơ"      => 'https://i.postimg.cc/TwvTG9yt/th.jpg',
            "tuấn ngọc"    => 'https://i.postimg.cc/NFpt6vdn/th.jpg',
            "huyr" => 'https://i.postimg.cc/pVZPbKPB/th.jpg',
            "hoàng lê vi"  => 'https://i.postimg.cc/LXVFSMFs/th.jpg',
            "phạm thành"   => 'https://i.postimg.cc/mrxvFrbD/th.jpg',
            "dj hfire" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "phương mỹ chi"    => 'https://i.postimg.cc/VkFh5WH7/th.jpg',
            "khôi nguyên"  => 'https://i.postimg.cc/J0J68Nk5/th.jpg',
            "kim thoa (bolero)"    => 'https://i.postimg.cc/9Qc83qFy/th.jpg',
            "trịnh thiên ân"   => 'https://i.postimg.cc/6pQrLVpb/th.jpg',
            "viruss" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "min"  => 'https://i.postimg.cc/t4VTj7SC/th.jpg',
            "erik" => 'https://i.postimg.cc/bv9qynQ8/th.jpg',
            "khắc hưng"    => 'https://i.postimg.cc/jjHSDmYp/th.jpg',
            "chillies" => 'https://i.postimg.cc/D08hPYRy/th.jpg',
            "trọng tấn"    => 'https://i.postimg.cc/SQvkxkzX/th.jpg',
            "châu dương"   => 'https://i.postimg.cc/Fskmf8jT/th.jpg',
            "khanh ha" => 'https://i.postimg.cc/Cxy0b77S/th.jpg',
            "đinh đại vũ"  => 'https://i.postimg.cc/jjtrFjB1/th.jpg',
            "đông đào"   => 'https://i.postimg.cc/qRZVqxgf/th.jpg',
            "thanh lam"    => 'https://i.postimg.cc/j2GpQqzZ/th.jpg',
            "lam anh"     => 'https://i.postimg.cc/MKB2ZRS4/th.jpg',
            "thế sơn"    => 'https://i.postimg.cc/jS6pPbC4/th.jpg',
            "tuấn phương"      => 'https://i.postimg.cc/B6zk4Zw4/th.jpg',
            "dj ciray" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "thanh ngân"   => 'https://i.postimg.cc/fRwNHLGr/th.jpg',
            "thanh hưng idol"  => 'https://i.postimg.cc/L4125GkN/th.jpg',
            "lala trần"    => 'https://i.postimg.cc/SxDpH4qN/th.jpg',
            "đức huy"  => 'https://i.postimg.cc/nVBfpBZW/th.jpg',
            "k-icm"    => 'https://i.postimg.cc/Dwf9rNsV/th.jpg',
            "jack (g5r)"   => 'https://i.postimg.cc/WpMCQVwL/th.jpg',
            "masew"    => 'https://i.postimg.cc/Z5qQBdt4/th.jpg',
            "nightcore" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "đoan trang"   => 'https://i.postimg.cc/5y3PjxsX/th.jpg',
            "lã"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "duy phúc" => 'https://i.postimg.cc/k5bfKNj3/th.jpg',
            "tib"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "v.a"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "duy hòa"  => 'https://i.postimg.cc/hvfJQsrV/th.jpg',
            "hoàng ngọc sơn"   => 'https://i.postimg.cc/Z5k90ryy/th.jpg',
            "hương lan"    => 'https://i.postimg.cc/Qx7CLHnN/th.jpg',
            "amee" => 'https://i.postimg.cc/63SWgXrG/th.jpg',
            "ricky star"   => 'https://i.postimg.cc/9FcmkJTb/th.jpg',
            "xuân phú" => 'https://i.postimg.cc/FsP4BmhF/th.jpg',
            "phan duy anh" => 'https://i.postimg.cc/C5mWXHTr/th.jpg',
            "dj" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "bảo yến"  => 'https://i.postimg.cc/P5mMqfNT/tieu-su-ca-si-bao-yen-4988.jpg',
            "chế linh" => 'https://i.postimg.cc/2jMdFLZC/th.jpg',
            "hương thủy"   => 'https://i.postimg.cc/rpfxdDTX/th.jpg',
            "mai thiên vân"    => 'https://i.postimg.cc/bYs4L5mk/th.jpg',
            "lý thu thảo"     => 'https://i.postimg.cc/vmYNn211/th.jpg',
            "hà vân"   => 'https://i.postimg.cc/tRZmFxgz/th.jpg',
            "hồng nhung"   => 'https://i.postimg.cc/4x58Xv8X/th.jpg',
            "bằng kiều"    => 'https://i.postimg.cc/6py7QtcT/th.jpg',
            "ngô thụy miên"    => 'https://i.postimg.cc/g2F9xKqR/th.jpg',
            "khánh ly" => 'https://i.postimg.cc/J0DgnysP/th.jpg',
            "dj teejay" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "dj xuân núi" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "hoàng lan"    => 'https://i.postimg.cc/qB64ggVP/th.jpg',
            "tuyết thanh"  => 'https://i.postimg.cc/qqTbkmdM/th.jpg',
            "công trứ"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "phạm quỳnh anh"   => 'https://i.postimg.cc/WpYqcdmx/th.jpg',
            "du thiên"    => 'https://i.postimg.cc/FzHPdY12/th.jpg',
            "dj andy" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "tuấn vũ"  => 'https://i.postimg.cc/tJvBh9x7/th.jpg',
            "hồ quang hiếu"    => 'https://i.postimg.cc/RFV1Gj9t/th.jpg',
            "dj rum barcadi" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "ẩn lan"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "minh chuyên"  => 'https://i.postimg.cc/664cSxnV/th.jpg',
            "cẩm vân"  => 'https://i.postimg.cc/8PhHpdyj/th.jpg',
            "hồng phấn"    => 'https://i.postimg.cc/W18wrNcV/th.jpg',
            "thái hiền"    => 'https://i.postimg.cc/LshL1jVk/th.jpg',
            "h0n"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "hòa minzy"    => 'https://i.postimg.cc/GtnyVVnz/th.jpg',
            "hùng cường"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "t.r.i"    => 'https://i.postimg.cc/vHQ1nWY1/th.jpg',
            "cammie"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "tuấn hưng"    => 'https://i.postimg.cc/MKPGjN34/th.jpg',
            "dj phong phạm"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "giang trang"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "đình phước"   => 'https://i.postimg.cc/G37vQ740/th.jpg',
            "dunghoangpham"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "dj tdj" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "hoàng oanh"   => 'https://i.postimg.cc/pLG6k4Fm/th.jpg',
            "thanh hoa"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "trịnh vĩnh trinh" => 'https://i.postimg.cc/0Q72J3Rg/th.jpg',
            "thanh lan"    => 'https://i.postimg.cc/fbdfXrjn/th.jpg',
            "thùy trang"       => 'https://i.postimg.cc/6pJ3qb3G/th.jpg',
            "ngọc huyền"   => 'https://i.postimg.cc/G90cB9c1/th.jpg',
            "thúy hà tú"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "việt hoàn (nsưt)" => 'https://i.postimg.cc/FzpMvR7Z/th.jpg',
            "anh thơ"  => 'https://i.postimg.cc/W1FHWS6S/th.jpg',
            "kiều hưng"    => 'https://i.postimg.cc/DyDCXLkG/th.jpg',
            "tấn sơn"  => 'https://i.postimg.cc/43GQ618Y/th.jpg',
            "x2x"  => 'https://i.postimg.cc/SKmc2xs8/th.jpg',
            "giáng tiên"   => 'https://i.postimg.cc/RqrHMMyW/th.jpg',
            "dương ngọc thái"  => 'https://i.postimg.cc/L4gvMhZ6/th.jpg',
            "khắc việt"    => 'https://i.postimg.cc/DyBSjPyW/th.jpg',
            "hamlet trương"    => 'https://i.postimg.cc/xCvCKK41/th.jpg',
            "lê sang"  => 'https://i.postimg.cc/63X658pJ/th.jpg',
            "kim thoa"    => 'https://i.postimg.cc/7hQy7hwL/th.jpg',
            "hà my"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "anh quân bolero"  => 'https://i.postimg.cc/zGZcQKtr/th.jpg',
            "elvis phương"    => 'https://i.postimg.cc/RVKBqM2v/th.jpg',
            "hoàng thùy linh"  => 'https://i.postimg.cc/LXwc67Tq/th.jpg',
            "jgkid (da lab)"   => 'https://i.postimg.cc/j26M0kkY/th.jpg',
            "lê dung (nsnd)"   => 'https://i.postimg.cc/zGZcQKtr/th.jpg',
            "k300" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "p.a.k"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "miu lê"   => 'https://i.postimg.cc/HscLzDKN/th.jpg',
            "ngọc yến"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "hồng năm"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "phùng khánh linh" => 'https://i.postimg.cc/0j3D4G91/th.jpg',
            "d.a"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "hồ gia khánh" => 'https://i.postimg.cc/k4gSXY4d/th.jpg',
            "wrc"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "kha"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "nger" => 'https://i.postimg.cc/sgCZZgXm/th.jpg',
            "trần đức"     => 'https://i.postimg.cc/V5Q5MKYv/th.jpg',
            "lệ thu"   => 'https://i.postimg.cc/7Y8gSVtS/th.jpg',
            "băng tâm" => 'https://i.postimg.cc/44tc4c4y/th.jpg',
            "thái sơn" => 'https://i.postimg.cc/DZGSZVTH/th.jpg',
            "sinike"   => 'https://i.postimg.cc/qq0vvzQ6/th.jpg',
            "cẩm hằng" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "đăng nguyên"  => 'https://i.postimg.cc/G2RCk6DZ/th.jpg',
            "hồng phượng"  => 'https://i.postimg.cc/tTkLFJpx/th.jpg',
            "hoàng việt trang" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "hàn thái tú"  => 'https://i.postimg.cc/dDPm1Rpm/th.jpg',
            "đào bá lộc"   => 'https://i.postimg.cc/y8T5MW3r/th.jpg',
            "bằng chương"  => 'https://i.postimg.cc/26WxfXX8/th.jpg',
            "various artists"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "trịnh công sơn"   => 'https://i.postimg.cc/4d1mt6YQ/th.jpg',
            "hương ly"   => 'https://i.postimg.cc/26C5z10b/th.jpg',
            "gia hy"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "green"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "trần thái hòa"    => 'https://i.postimg.cc/2yRNzMkH/th.jpg',
            "quang lý"    => 'https://i.postimg.cc/3xJ5JghH/th.jpg',
            "nguyên"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "trang"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "ac&m"    => 'https://i.postimg.cc/1zfkDs4C/th.jpg',
            "raditori" => 'https://i.postimg.cc/4y5LrSmH/th.jpg',
            "vũ khanh" => 'https://i.postimg.cc/G2zvrwxR/th.jpg',
            "jombie"   => 'https://i.postimg.cc/2jcnKY5F/th.jpg',
            "ngọt"     => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "tuyên"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "mèow lạc" => 'https://i.postimg.cc/G35sjjMX/th.jpg',
            "pháo"     => 'https://i.postimg.cc/mgxzvgWM/th.jpg',
            "những đứa trẻ"        => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "vũ phụng tiên"    => 'https://i.postimg.cc/W41r2pX4/th.jpg',
            "audicity" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "ngô lan hương"    => 'https://i.postimg.cc/26q0S723/th.jpg',
            "cukak"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "hà phương"    => 'https://i.postimg.cc/L5K36KJ0/th.jpg',
            "kiều nga"    => 'https://i.postimg.cc/28Y7sYR1/th.jpg',
            "w/n"      => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "tez"      => 'https://i.postimg.cc/KjDBGKSR/th.jpg',
            "tien"     => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "hương tràm"   => 'https://i.postimg.cc/JhHXyYCw/th.jpg',
            "tuấn hòa"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "quỳnh trang"  => 'https://i.postimg.cc/526YGK0H/th.jpg',
            "phát huy t4"  => 'https://i.postimg.cc/8P3PFpp5/th.jpg',
            "truzg"     => 'https://i.postimg.cc/MZ3z46jD/th.jpg',
            "bảo anh"    => 'https://i.postimg.cc/J4bMhb2T/th.jpg',
            "hiền thục"    => 'https://i.postimg.cc/vTYkHVgK/th.jpg',
            "mã tuyết nga" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "hoài lâm"     => 'https://i.postimg.cc/0jHzV7pR/th.jpg',
            "đan trường"   => 'https://i.postimg.cc/zv9JL7CB/th.jpg',
            "gill" => 'https://i.postimg.cc/ZRQmgHDc/th.jpg',
            "rpt orijinn"  => 'https://i.postimg.cc/L8PVZsp6/th.jpg',
            "ngô kiến huy" => 'https://i.postimg.cc/XNDhfXTw/th.jpg',
            "long hải"    => 'https://i.postimg.cc/Zq5Y9CG1/th.jpg',
            "nal"        => 'https://i.postimg.cc/s2bFVxsP/th.jpg',
            "tvk (lê gia quân)"    => 'https://i.postimg.cc/L6DrJNm8/th.jpg',
            "đình phong"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "giang jolee"  => 'https://i.postimg.cc/ZKQxsdcL/th.jpg',
            "hoàng y nhung"    => 'https://i.postimg.cc/15g9w83F/th.jpg',
            "thịnh suy"    => 'https://i.postimg.cc/LXXsWN2C/th.jpg',
            "chu duyên"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "dayoff"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "nguyễn thạc bảo ngọc" => 'https://i.postimg.cc/x8GMf6Nv/th.jpg',
            "khôi vũ"  => 'https://i.postimg.cc/3RFxWV9x/th.jpg',
            "đức long" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "trúc mai" => 'https://i.postimg.cc/hvbn2dN4/th.jpg',
            "đình nguyên"  => 'https://i.postimg.cc/pXCx8KDq/th.jpg',
            "dương minh tuấn"  => 'https://i.postimg.cc/1znZLTbj/th.jpg',
            "dj minh lý"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "tăng duy tân" => 'https://i.postimg.cc/xTh564yC/th.jpg',
            "pak band" => 'https://i.postimg.cc/kMhLdwvr/th.jpg',
            "binz" => 'https://i.postimg.cc/28yb1jWb/th.jpg',
            "mr. a"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "dương khắc linh"  => 'https://i.postimg.cc/1RC41xd9/th.jpg',
            "bức tường"    => 'https://i.postimg.cc/wBLFnQTp/th.jpg',
            "vương bảo tuấn"   => 'https://i.postimg.cc/nhjJ5rjJ/th.jpg',
            "julie"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "soobin hoàng sơn" => 'https://i.postimg.cc/05V1yD7v/th.jpg',
            "bằng cường"   => 'https://i.postimg.cc/RCDpYRcW/th.jpg',
            "ngô văn thực" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "hồng năm" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "đàm vĩnh hưng"    => 'https://i.postimg.cc/1zFN9yTx/th.jpg',
            "vuông"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "woni" => 'https://i.postimg.cc/d3N02fXm/d3a3ca49890b551fb8ef621111cf627e-608x608x1.jpg',
            "phát hồ"  => 'https://i.postimg.cc/jS0bpKzn/th.jpg',
            "giấy gấp" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "thiên tú" => 'https://i.postimg.cc/Wpxz1BGT/th.jpg',
            "jaigon orchestra" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "bùi trường linh"      => 'https://i.postimg.cc/cHgZqJ5Y/th.jpg',
            "phí phương anh"   => 'https://i.postimg.cc/Qdw04x5v/th.jpg',
            "rin9" => 'https://i.postimg.cc/6QKG5kNy/th.jpg',
            "thoại 004"    => 'https://i.postimg.cc/W1vMhFGN/th.jpg',
            "jsol" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "hoàng duyên"  => 'https://i.postimg.cc/NG2TD7bG/th.jpg',
            "chủ tịch kim" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "b ray"    => 'https://i.postimg.cc/T2n1hkCb/th.jpg',
            "quang dũng"   => 'https://i.postimg.cc/nzbZJx8P/th.jpg',
            "mỹ linh"  => 'https://i.postimg.cc/Dyz9R0Jz/th.jpg',
            "trương thảo nhi"  => 'https://i.postimg.cc/kMHsXgYG/th.jpg',
            "trương hoàng xuân"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "nguyên vũ"    => 'https://i.postimg.cc/HkY968VS/th.jpg',
            "thái bảo"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "hoàng nhật minh"  => 'https://i.postimg.cc/BQqF394b/th.jpg',
            "thu thủy"    => 'https://i.postimg.cc/x89X9Mrh/th.jpg',
            "khánh tân"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "phương nga"   => 'https://i.postimg.cc/DZnvGhCb/th.jpg',
            "minh quang"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "hà phương linh"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "tuấn cry"    => 'https://i.postimg.cc/HWfp0bPg/tuan-cry-ra-mat-diss-track-corona-tong-hop-trend-dau-nam-2020-4c16336e.jpg',
            "tùng viu"    => 'https://i.postimg.cc/KjhHjcQd/th.jpg',
            "nguyen jenda" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "hồ việt trung"    => 'https://i.postimg.cc/zBZjStWh/th.jpg',
            "phạm sắc lệnh"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "fireprox" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "the flob"     => 'https://i.postimg.cc/FRrf40Xq/th.jpg',
            "bmz"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "chung thanh duy"  => 'https://i.postimg.cc/bwF8JbnW/th.jpg',
            "7uppercuts"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "the a plan"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "quốc hưng (nsưt)" => 'https://i.postimg.cc/ncg0hhzT/th.jpg',
            "lê sơn"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "mlee" => 'https://i.postimg.cc/MpjDgJz4/th.jpg',
            "mc minh cảnh" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "nam anh"  => 'https://i.postimg.cc/Y0WZpngq/th.jpg',
            "dj eric t-j"          => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "jokes bii"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "thiện"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "lâm minh thảo"    => 'https://i.postimg.cc/rsgT6YL0/th.jpg',
            "lưu ánh loan"    => 'https://i.postimg.cc/6q6shLG9/th.jpg',
            "đoàn minh"    => 'https://i.postimg.cc/fW3W1M3D/th.jpg',
            "bmktcr"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "thu lan"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "thanh thúy"   => 'https://i.postimg.cc/gJ7hd4qJ/bb4x.jpg',
            "phi nhung"    => 'https://i.postimg.cc/sDsWzB55/th.jpg',
            "the cassette" => 'https://i.postimg.cc/bv9XKBPx/untitled-16367776555341552481450.png',
            "orange"   => 'https://i.postimg.cc/1z7xmNgX/th.jpg',
            "khói"    => 'https://i.postimg.cc/VsMhThFd/tieu-su-ca-si-khoi-9808.jpg',
            "châu đăng khoa"   => 'https://i.postimg.cc/NFwdBgxL/tieu-su-ca-si-chau-dang-khoa-6837.jpg',
            "ái xuân"  => 'https://i.postimg.cc/RZbGq1Tk/th.jpg',
            "kis"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "hoàng kaylee" => 'https://i.postimg.cc/gjN8QdSC/ab6761610000e5eb5887df3a98b9bf055c5c4262.jpg',
            "yahy" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "tấn minh" => 'https://i.postimg.cc/Xqm7pzpZ/th.jpg',
            "phương liên"  => 'https://i.postimg.cc/T1DvHY3w/bb6h.jpg',
            "gray" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "wind" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "vạch kẻ đường"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "vi hoa (nsưt)"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "thu hiền"    => 'https://i.postimg.cc/PJMPJh3R/th.jpg',
            "dj acid"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "machiot"  => 'https://i.postimg.cc/WbYfJPNY/bf0f.jpg',
            "mỹ lệ"    => 'https://i.postimg.cc/hPv2n3LL/th.jpg',
            "ái vân"   => 'https://i.postimg.cc/9FsYhXF2/th.jpg',
            "đức phúc" => 'https://i.postimg.cc/HWzmfQVX/th.jpg',
            "hoàng linh"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "mai quốc hoàng"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "justatee" => 'https://i.postimg.cc/xCWKLYpY/th.jpg',
            "đen"  => 'https://i.postimg.cc/CKRB7XqK/th.jpg',
            "khánh bình"   => 'https://i.postimg.cc/656QzFsN/th.jpg',
            "phương thanh" => 'https://i.postimg.cc/GpD3HCDv/th.jpg',
            "2t"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "văn"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "phong max"    => 'https://i.postimg.cc/zD7zLpy2/1567564227398-600.jpg',
            "thúy khanh"   => 'https://i.postimg.cc/Gm8d5Cq6/unnamed.jpg',
            "nsnd quang thọ"   => 'https://i.postimg.cc/63zkQjMd/nsndquangtho09215435434-2792018.jpg',
            "tuấn vũ"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "thanh tuyền" => 'https://i.postimg.cc/7PKNB8C3/th.jpg',
            "phan mạnh quỳnh"  => 'https://i.postimg.cc/RhYVWVgQ/th.jpg',
            "khánh trung"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "trịnh thăng bình" => 'https://i.postimg.cc/g0GdkZYb/th.jpg',
            "trung quân idol" => 'https://i.postimg.cc/DZJ7tKvS/th.jpg',
            "nguyenn"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "aric"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "nguyễn văn chung" => 'https://i.postimg.cc/7PKNB8C3/th.jpg',
            "andree right hand"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "mck (rpt)"    => 'https://i.postimg.cc/PNGJ651f/MCK-696x696.webp',
            "tlinh"    => 'https://i.postimg.cc/htBbvSNq/th.jpg',
            "amy đan linh" => 'https://i.postimg.cc/k5jxTWGn/th.jpg',
            "gbikey"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "xuân sâm" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "krix"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "rush (đoàn quốc vinh)"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "nhi nhi"      => 'https://i.postimg.cc/GmmtqVyy/Ca-s-Nhi-Nhi-1.jpg',
            "np.2" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "phương vy"    => 'https://i.postimg.cc/gcQ0MbYb/th.jpg',
            "luke d"   => 'https://i.postimg.cc/vBrGQtny/th.jpg',
            "pháp kiều"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "huỳnh james"  => 'https://i.postimg.cc/Dyy7TswV/3eefd9309082ed0bba93b88c39d8ffee-1512529942.jpg',
            "pjnboys"  => 'https://i.postimg.cc/vZCyfNLM/th.jpg',
            "gala nhac viet"   => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "2pillz"   => 'https://i.postimg.cc/0QfhWWmz/th.jpg',
            "cá chép"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "tracy thảo my"    => 'https://i.postimg.cc/vmrk5snf/th.jpg',
            "n ly" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "cassano"  => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "bluebby"  => 'https://i.postimg.cc/4NFg3sv3/th.jpg',
            "ti ti (hkt)"  => 'https://i.postimg.cc/PJXjCqFC/th.jpg',
            "diệu kiên"    => 'https://i.postimg.cc/3RChrG9M/th.jpg',
            "huỳnh văn tín"        => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "vicky nhung"  => 'https://i.postimg.cc/VL7Ybjwm/th.jpg',
            "vương"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "mono"     => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "onionn"   => 'https://i.postimg.cc/RVvFtSnQ/th.jpg',
            "chu thúy quỳnh"   => 'https://i.postimg.cc/przFLq4W/th.jpg',
            "quang hà" => 'https://i.postimg.cc/Xv1FHZ9b/th.jpg',
            "hồng thái"    => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            "thiện nguyễn" => 'https://i.postimg.cc/CMqt7f1Z/image.png',
            'bình minh vũ' =>'https://i.postimg.cc/D0HY94jF/image.png',
            'kelvin khánh' => 'https://i.postimg.cc/qq1JVTW4/image.png',
            'myra trần' => 'https://i.postimg.cc/gjHDGMKY/image.png',
            'võ hạ trâm'    => 'https://i.postimg.cc/gjHDGMKY/image.png',
        ];
        foreach ($songs as $i => $song) {
            $artistsMulti = [];
            $genresMulti = [];
            $filePath = $song->getPathname();
            $fileName = $song->getFilename();
            $getID3 = new getID3();
            $fileInfo = $getID3->analyze($filePath);
            $tags = isset($fileInfo['tags']) ? $fileInfo['tags'] : null;
            $title = isset($tags['id3v2']['title'][0]) ? $tags['id3v2']['title'][0] : null;
            $genresArr = isset($tags['id3v2']['genre']) ? $tags['id3v2']['genre'] : null;
            $artistsArr = isset($tags['id3v2']['artist']) ? $tags['id3v2']['artist'] : null;
            if (is_array($artistsArr)) {
                $artistsMulti[] = $artistsArr;
            }
            if (is_array($genresArr)) {
                foreach ($genresArr as $item) {
                    $genresMulti[] = $item;
                }
            }
            $duration = '00:00:00';
            if (isset($fileInfo['playtime_seconds'])) {
                $duration = gmdate('H:i:s', $fileInfo['playtime_seconds']);
            }


            Db::table('songs')->insert([
                'user_id' => 1,
                'name' =>  $title ? $title : $fileName,
                'img_url' => 'https://i.postimg.cc/mrg9mz3N/image.png',
                'url' =>  $fileName,
                'duration' => $duration,
                'description' => $fileName,
                'lyric' => 'No Information',
                'musician' => /* isset($tags['id3v2']['artist']) ? implode(', ', $tags['id3v2']['artist']) : */ 'No Information',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $flatArtistsMulti = array_merge(...$artistsMulti);
            $artistsSongFile = [];
            foreach ($flatArtistsMulti as $item) {
                $subArray = explode(', ', $item);
                $artistsSongFile = array_merge($artistsSongFile, $subArray);
            }
            $artistsSongFile = array_unique($artistsSongFile);
            foreach ($artistsSongFile as $item) {
                $artistName = mb_strtolower($item);
                $exists = DB::table('artists')->where('name', $artistName)->first();
                if (!$exists) {
                    DB::table('artists')->insertGetId([
                        'user_id' => 1,
                        'name' => $artistName,
                        'img_url' => $artistImg[$artistName] ? $artistImg[$artistName] : 'https://i.postimg.cc/mrg9mz3N/image.png',
                        'bio' => 'No Information',
                        'created_at' => now(),
                    ]);
                    DB::table('albums')->insertGetId([
                        'user_id' => 1,
                        'name' => 'album ' . $artistName,
                        'release_date' => '2021-01-01',
                        'img_url' => $artistImg[$artistName] ? $artistImg[$artistName] : 'https://i.postimg.cc/mrg9mz3N/image.png',
                        'created_at' => now(),
                    ]);
                }
            }

            $idAtists = DB::table('artists')->whereIn('name', $artistsSongFile)->pluck('id');
            $idSong = DB::table('songs')->where('name', $title ? $title : $fileName)->pluck('id');

            foreach ($idAtists as $id) {
                if ($id != null) {
                    DB::table('artist_song')->insert([
                        'artist_id' => $id,
                        'song_id' => $idSong[0],
                        'created_at' => now(),
                    ]);
                }
            }

            $genresMulti = array_map('strtolower', $genresMulti);
            $genresSongFile = array_unique($genresMulti);
            foreach ($genresSongFile as $genreName) {
                $exists =  DB::table('genres')->where('name', $genreName)->first();
                if (!$exists) {
                    DB::table('genres')->insertGetId([
                        'user_id' => 1,
                        'name' => $genreName,
                        'img_url' => $genreImg[$genreName] ? $genreImg[$genreName] : 'https://i.postimg.cc/KzY53psb/image.png',
                        'description' => 'No Description',
                        'created_at' => now(),
                    ]);
                }
            }

            $idGenres =  DB::table('genres')->whereIn('name', $genresArr)->pluck('id');
            foreach ($idGenres as $id) {
                if ($id != null) {
                    DB::table('genre_song')->insert([
                        'genre_id' => $id,
                        'song_id' => $idSong[0],
                        'created_at' => now(),
                    ]);
                }
            }

            $artistsSongFile = array_map(function ($artist) {
                return 'album ' . $artist;
            }, $artistsSongFile);
            $idAlbums = DB::table('albums')->whereIn('name', $artistsSongFile)->pluck('id');
            foreach ($idAlbums as $id) {
                DB::table('album_song')->insert([
                    'album_id' => $id,
                    'song_id' => $idSong[0],
                    'created_at' => now(),
                ]);
            }
        }
    }
}
