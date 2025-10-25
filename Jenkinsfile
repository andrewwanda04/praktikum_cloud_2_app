pipeline {
    agent any

    environment {
        IMAGE_NAME = "praktikum2-app"
        CONTAINER_NAME = "praktikum2_app"
    }

    stages {
        stage('Checkout Code') {
            steps {
                git branch: 'main', url: 'https://github.com/andrewwanda04/praktikum2-app.git'
            }
        }

        stage('Build Docker Images') {
            steps {
                bat 'docker-compose build'
            }
        }

        stage('Run Docker Containers') {
            steps {
                bat '''
                echo Matikan container lama...
                docker stop praktikum2_app || echo "tidak jalan"
                docker rm praktikum2_app || echo "tidak ada"
                docker stop praktikum2_db || echo "tidak jalan"
                docker rm praktikum2_db || echo "tidak ada"

                echo Jalankan docker-compose baru...
                docker-compose down || exit 0
                docker-compose up -d
                '''
            }
        }

        stage('Verify App') {
            steps {
                bat '''
                echo Cek koneksi ke aplikasi...
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
            echo '✅ Aplikasi Laravel Calculator berhasil dijalankan via Docker Compose di port 8082!'
        }
        failure {
            echo '❌ Build gagal, cek log Jenkins console output.'
        }
    }
}
