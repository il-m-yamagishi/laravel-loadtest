import uuid
from locust import HttpUser, task, between

class LaravelLoadTestUser(HttpUser):
    wait_time = between(1, 5)
    headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }

    @task
    def index(self):
        self.client.get("/api")

    @task
    def register(self):
        self.client.post("/api/register", json={
            "name":"example",
            "email":"email" + str(uuid.uuid4()) + "@example.test",
            "password": "secretsecret",
            "password_confirmation": "secretsecret"
        }, headers = self.headers)
