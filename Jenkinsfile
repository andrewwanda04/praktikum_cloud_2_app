pipeline {
    agent any

    environment {
        IMAGE_NAME = "praktikum2-app"
        CONTAINER_NAME = "praktikum2_app"
    }

    stages {
        stage('Checkout Code') {
            steps {
                git branch: 'main',
                    credentialsId: 'github-token',
                    url: 'https://github.com/andrewwanda04/praktikum2-app.git'
            }
        }

        stage('Build Docker Images') {
            steps {
                bat '''
                echo ===========================
                echo BUILDING DOCKER IMAGES...
                echo ===========================
                docker-compose build
                '''
            }
        }

        stage('Run Docker Containers') {
            steps {
                bat '''
                echo ===========================
                echo HENTIKAN CONTAINER LAMA...
                echo ===========================
                docker stop praktikum2_app || echo "tidak jalan"
                docker rm praktikum2_app || echo "tidak ada"
                docker stop praktikum2_db || echo "tidak jalan"
                docker rm praktikum2_db || echo "tidak ada"

                echo ===========================
                echo JALANKAN CONTAINER BARU...
                echo ===========================
                docker-compose down || exit 0
                docker-compose up -d

                echo Tunggu 15 detik agar Laravel siap...
                ping 127.0.0.1 -n 16 > nul
                '''
            }
        }

        stage('Verify App') {
            steps {
                bat '''
                echo ===========================
                echo CEK KONEKSI KE APLIKASI...
                echo ===========================
                curl -I http://localhost:8082 || echo "Gagal akses aplikasi di port 8082"

                echo.
                echo ==== ISI HALAMAN ====
                curl http://localhost:8082 || echo "Gagal ambil isi halaman"
                echo =====================
                '''
            }
        }
    }

    post {
        success {
            echo '✅ Aplikasi Laravel berhasil dijalankan via Docker Compose di port 8082!'
        }
        failure {
            echo '❌ Build gagal, cek log Jenkins console output.'
        }
    }
}
