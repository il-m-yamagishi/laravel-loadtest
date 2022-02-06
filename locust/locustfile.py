import uuid
from locust import HttpUser, task, between

class LaravelLoadTestUser(HttpUser):
    wait_time = between(1, 5)
    headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
    login_token = ""

    def authHeaders(self):
        return {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + self.login_token
        }

    @task
    def register(self):
        self.client.get("/", headers = self.headers)

        with self.client.post("/register", json={
            "name": "example",
            "email": str(uuid.uuid4()) + "@laravel-load.test",
            "password": "secretsecret"
        }, headers = self.headers, catch_response=True) as response:
            self.login_token = response.json()["login_token"]

        self.client.post("/login", json={
            "password": "secretsecret",
            "login_token": self.login_token
        }, headers = self.headers)

        self.client.get("/user", json={}, headers = self.authHeaders())
