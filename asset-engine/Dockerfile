FROM python:3.12-slim-bookworm

WORKDIR /app

RUN apt-get update && apt-get install -y --no-install-recommends \
    liblzma-dev \
    && rm -rf /var/lib/apt/lists/*

COPY requirements.txt .
RUN pip install --no-cache-dir -r requirements.txt

COPY . .

ENV RAVYN_OTC_ROOT=/otclient
ENV PYTHONUNBUFFERED=1

EXPOSE 8765

CMD ["python", "main.py", "serve", "--host", "0.0.0.0", "--port", "8765"]
