<?php
$today = date('Y-m-d');

$hariIni = mysqli_query($koneksi, "SELECT count(*) total, SUM(amounth) omzet FROM orders WHERE DATE(date) = '$today' 
AND status=1");
$dataHarian = mysqli_fetch_assoc($hariIni);

$mingguan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT count(*) total, SUM(amounth) omzet 
FROM orders WHERE YEARWEEK(date, 1) = YEARWEEK(CURDATE(), 1) AND status = 1"));

$bulanan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT count(*) total, SUM(amounth) omzet 
FROM orders WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE()) AND status = 1"));
?>

<h1>renzkyyyy</h1>

<div class="row">
              <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Hari ini</p>
                          <h4 class="card-title">
                            Rp. : <?= number_format($dataHarian['omzet']) ?>
                          </h4>
                          <p class="card-subtitle">
                            Total Transaksi : <?= number_format($dataHarian['total']) ?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-info bubble-shadow-small"
                        >
                          <i class="fas fa-user-check"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Minggu ini</p>
                          <h4 class="card-title">
                            Rp. : <?= number_format($mingguan['omzet']) ?>
                          </h4>
                          <p class="card-total">
                            Total Transaksi : <?= $mingguan['total'] ?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-success bubble-shadow-small"
                        >
                          <i class="fas fa-luggage-cart"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Bulan ini</p>
                          <h4 class="card-title">
                            Rp. : <?= number_format($bulanan['omzet']) ?>
                          </h4>
                          <p class="card-total">
                            Total Transaksi : <?= $mingguan['total'] ?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>