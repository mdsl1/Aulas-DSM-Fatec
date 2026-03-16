import os
import subprocess

print("Iniciando build...")

print("\nInstalando dependências...")
subprocess.run([ "pip", "install", "-r", "requirements.txt" ])

print("\nCompilando código...")
subprocess.run([ "python", "-m", "compileall", "." ])

print("\nExecutando aplicação...")
subprocess.run([ "python", "app.py" ])

print("\nBuild finalizada.")
