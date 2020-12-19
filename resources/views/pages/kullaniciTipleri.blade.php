{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom card-stretch gutter-b">

        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">Kullanıcı Tipleri Listesi</span>
                <span
                    class="text-muted mt-3 font-weight-bold font-size-sm">Yetki tiplerini görüntüleyin ve düzenleyin.</span>
            </h3>
            <div class="card-toolbar">
                <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                    <li class="nav-item">
                        <button type="button" id="kullaniciTipiEkle" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">Yeni Kullanıcı Tipi Ekle
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog"
             aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yeni Kullanıcı Tipi Ekle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form">
                            <div class="form-group">
                                <label>Kullanıcı Tipi Adı
                                    <span class="text-danger">*</span></label>
                                <input type="text" class="form-control">
                                <span
                                    class="form-text text-muted">Kullanıcı tipinizi daha sonra hızlıca kullanabilmek için oluşturun ve isimlendirin.</span>
                                <div class="separator separator-dashed my-5"></div>
                            </div>
                            <div class="form-group">
                                <h2>Yetkiler</h2>
                                <div class="separator separator-dashed my-5"></div>
                                <h4>Kullanıcı ve Çalışan Yetkileri</h4>
                                <div class="checkbox-inline">
                                    <label class="checkbox">
                                        <input type="checkbox" name="calisanGoruntule">
                                        <span></span>Çalışan Görüntüle</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="calisanEkle">
                                        <span></span>Çalışan Ekle</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="calisanDuzenle">
                                        <span></span>Çalışan Düzenle</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="calisanSil">
                                        <span></span>Çalışan Sil<p
                                            class="text-danger">!</p></label>
                                </div>
                                <div class="separator separator-dashed my-5"></div>
                                <div class="checkbox-inline">
                                    <label class="checkbox">
                                        <input type="checkbox" name="kullaniciGoruntule">
                                        <span></span>Kullanıcıları Görüntüle</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="kullaniciEkle">
                                        <span></span>Kullanıcı Ekle</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="kullaniciDuzenle">
                                        <span></span>Kullanıcı Düzenle</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="kullaniciSil">
                                        <span></span>Kullanıcı Sil<p
                                            class="text-danger">!</p></label>
                                </div>
                                <div class="separator separator-dashed my-5"></div>
                                <h4>Şantiye Yetkileri</h4>
                                <div class="checkbox-inline">
                                    <label class="checkbox">
                                        <input type="checkbox" name="kullaniciGoruntule">
                                        <span></span>Şantiyeler Listesini Görüntüle</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="kullaniciEkle">
                                        <span></span>Şantiye Ekle</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="kullaniciDuzenle">
                                        <span></span>Şantiye Düzenle</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="kullaniciGoruntule">
                                        <span></span>
                                        Şantiyelerin Tümünü Görüntüle<p
                                            class="text-danger">!</p></label>
                                </div>
                                <div class="separator separator-dashed my-5"></div>
                                <div class="checkbox-inline">
                                    <label class="checkbox">
                                        <input type="checkbox" name="kullaniciGoruntule">
                                        <span></span>Puantajı Görüntüle</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="kullaniciEkle">
                                        <span></span>Puantajı Ekle</label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="kullaniciDuzenle">
                                        <span></span>Puantajı Onayla<p
                                            class="text-danger">!</p></label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="kullaniciDuzenle">
                                        <span></span>Puantajı Düzenle<p
                                            class="text-danger">!</p></label>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-5"></div>
                            <div class="checkbox-inline">
                                <label class="checkbox">
                                    <input type="checkbox" name="kullaniciGoruntule">
                                    <span></span>Şantiye Giderleri Görüntüle</label>
                                <label class="checkbox">
                                    <input type="checkbox" name="kullaniciEkle">
                                    <span></span>Şantiye Giderleri Ekle</label>
                                <label class="checkbox">
                                    <input type="checkbox" name="kullaniciDuzenle">
                                    <span></span>Şantiye Giderleri Düzenle<p
                                        class="text-danger">!</p></label>
                                <label class="checkbox">
                                    <input type="checkbox" name="kullaniciDuzenle">
                                    <span></span>Şantiye Giderleri Sil<p
                                        class="text-danger">!</p></label>
                            </div>
                            <div class="separator separator-dashed my-5"></div>
                            <div class="checkbox-inline">
                                <label class="checkbox">
                                    <input type="checkbox" name="kullaniciGoruntule">
                                    <span></span>Şantiye Çalışan Maaşları Görüntüle</label>
                                <label class="checkbox">
                                    <input type="checkbox" name="kullaniciEkle">
                                    <span></span>Şantiye Çalışan Maaşları Ödeme Talebi Oluştur<p
                                        class="text-danger">!</p></label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold"
                                data-dismiss="modal">Kapat
                        </button>
                        <button type="submit" class="btn btn-primary font-weight-bold">Kaydet</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-body">


            <table class="table table-bordered table-hover" id="calisan_maaslar">
                <thead>
                <tr>
                    <th>Kullanıcı Profili</th>
                    <th>Kayıtlı Kullanıcı Sayısı</th>
                    <th>Oluşturan Kişi</th>
                    <th>Yetkiler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($kullaniciTipleri  as $kullaniciTipi)
                    <tr>
                        <td>{{$kullaniciTipi['adi']->adi}}</td>
                        <td>NaN</td>
                        <td>{{$kullaniciTipi['olusturan_id']}}</td>
                        <td>{{$kullaniciTipi['yevmiye']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection

{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection


{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

    {{-- page scripts --}}
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endsection
