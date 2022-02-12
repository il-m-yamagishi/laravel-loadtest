import uuid
from locust import HttpUser, task, between

class LaravelLoadTestUser(HttpUser):
    wait_time = between(1, 5)

    def getHeaders(self, login_token=None):
        headers = {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        }
        if login_token is not None:
            headers['Authorization'] = 'Bearer ' + login_token

        return headers

    @task
    def register(self):
        self.client.get("/", headers = self.getHeaders())

        login_token = None
        with self.client.post("/register", json={
            "name": "example",
            "email": str(uuid.uuid4()) + "@laravel-load.test",
            "password": "secretsecret"
        }, headers = self.getHeaders(), catch_response=True) as response:
            if response.status_code != 200:
                response.failure(exc="Invalid code: " + str(response.status_code))
                return
            login_token = response.json()["login_token"]
            response.success()

        self.client.post("/login", json={
            "password": "secretsecret",
            "login_token": login_token
        }, headers = self.getHeaders(login_token))

        self.client.get("/user", json={}, headers = self.getHeaders(login_token))
