pipeline {
    agent any
     triggers {
        pollSCM('H/2 * * * *') // Polls the SCM every 2 minutes
    }
    stages {

        stage('Clone Repository') {
            steps {
                // Replace with your actual GitHub repository URL
                git branch: 'main', url: 'https://github.com/Kzizah/Beauty_parlour_Management_System.git'
            }
        }

        stage('Run Docker Version and Docker Compose Version') {
            steps {
                // Check Docker version
                sh 'docker --version'

                // Check Docker Compose version
                sh 'docker-compose --version'
            }
        }

        stage('Run Docker Compose to Start the Project') {
            steps {
                // Build and start the project
                sh 'docker-compose up -d --build'
            }
        }

    }
}
