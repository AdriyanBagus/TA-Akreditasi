<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container-fluid py-4">
                    <div class="row">
                      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <a href="{{ route('pages.visi_misi') }}">
                            <div class="card">
                              <div class="card-body p-3">
                                <div class="row">
                                  <div class="col-8">
                                    <div class="numbers">
                                      <p class="text-xs mb-0 text-uppercase font-weight-bold">Analisis Visi Misi</p>
                                      <h5 class="font-weight-bolder">2</h5>
                                      <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder"></span> 2025
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </a>
                      </div>
                      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <a href="{{ route('pages.kerjasama_pendidikan') }}">
                            <div class="card">
                                <div class="card-body p-3">
                                  <div class="row">
                                    <div class="col-8">
                                      <div class="numbers">
                                        <p class="text-xs mb-0 text-uppercase font-weight-bold">Kerjasama Pendidikan</p>
                                        <h5 class="font-weight-bolder">
                                          2
                                        </h5>
                                        <p class="mb-0">
                                          <span class="text-success text-sm font-weight-bolder"></span>
                                          2025
                                        </p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </a>
                      </div>
                      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <a href="{{ route('pages.kerjasama_penelitian') }}">
                            <div class="card">
                                <div class="card-body p-3">
                                  <div class="row">
                                    <div class="col-8">
                                      <div class="numbers">
                                        <p class="text-xs mb-0 text-uppercase font-weight-bold">Kerjasama Penelitian</p>
                                        <h5 class="font-weight-bolder">
                                          2
                                        </h5>
                                        <p class="mb-0">
                                          <span class="text-success text-sm font-weight-bolder"></span>
                                          2025
                                        </p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </a>
                      </div>
                      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <a href="{{ route('pages.kerjasama_pengabdian_kepada_masyarakat') }}">
                            <div class="card">
                                <div class="card-body p-3">
                                  <div class="row">
                                    <div class="col-8">
                                      <div class="numbers">
                                        <p class="text-xs mb-0 text-uppercase font-weight-bold">Ketersediaan Dokumen</p>
                                        <h5 class="font-weight-bolder">
                                          2
                                        </h5>
                                        <p class="mb-0">
                                          <span class="text-success text-sm font-weight-bolder"></span>
                                          2025
                                        </p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </a>
                      </div>
                    </div>
                </div>

                <div class="container-fluid py-4">
                  <div class="row">
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                      <a href="{{ route('pages.diagram_view') }}">
                          <div class="card">
                            <div class="card-body p-3">
                              <div class="row">
                                <div class="col-8">
                                  <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">Ketersediaan Dokumen</p>
                                    <h5 class="font-weight-bolder">2</h5>
                                    <p class="mb-0">
                                      <span class="text-success text-sm font-weight-bolder"></span> 2025
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                      <a href="{{ route('pages.kerjasama_pendidikan') }}">
                          <div class="card">
                              <div class="card-body p-3">
                                <div class="row">
                                  <div class="col-8">
                                    <div class="numbers">
                                      <p class="text-xs mb-0 text-uppercase font-weight-bold">Evaluasi Pelaksanaan</p>
                                      <h5 class="font-weight-bolder">
                                        2
                                      </h5>
                                      <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder"></span>
                                        2025
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                      </a>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                      <a href="{{ route('pages.kerjasama_penelitian') }}">
                          <div class="card">
                              <div class="card-body p-3">
                                <div class="row">
                                  <div class="col-8">
                                    <div class="numbers">
                                      <p class="text-xs mb-0 text-uppercase font-weight-bold">Profil Dosen</p>
                                      <h5 class="font-weight-bolder">
                                        2
                                      </h5>
                                      <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder"></span>
                                        2025
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                      </a>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                      <a href="{{ route('pages.kerjasama_pengabdian_kepada_masyarakat') }}">
                          <div class="card">
                              <div class="card-body p-3">
                                <div class="row">
                                  <div class="col-8">
                                    <div class="numbers">
                                      <p class="text-xs mb-0 text-uppercase font-weight-bold">Beban Kinerja Dosen</p>
                                      <h5 class="font-weight-bolder">
                                        2
                                      </h5>
                                      <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder"></span>
                                        2025
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                      </a>
                    </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>
