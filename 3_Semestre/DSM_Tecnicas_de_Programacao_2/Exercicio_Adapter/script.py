# A Interface Alvo (Target) que o nosso sistema cliente conhece e espera.
class NotificationInterface:
    # Define a interface padrão para todos os serviços de notificação.
    def send(self, message: str):
        raise NotImplementedError("Este método deve ser implementado por subclasses.")

# --- Serviços a serem adaptados ---
# Cada um tem sua própria interface (métodos com nomes e parâmetros diferentes).

# Serviço específico para enviar emails.
class EmailService:
    def send_email(self, subject: str, body: str):
        print(f"--- EMAIL ENVIADO ---")
        print(f"Assunto: {subject}")
        print(f"Corpo: {body}\n")

# Serviço específico para enviar SMS.
class SMSService:
    def send_sms(self, number: str, message: str):
        print(f"--- SMS ENVIADO ---")
        print(f"Para: {number}")
        print(f"Mensagem: {message}\n")

# Serviço específico para postar no Twitter.
class TwitterService:
    def post_tweet(self, message: str):
        print(f"--- TWEET POSTADO ---")
        print(f"Tweet: {message}\n")

# Os Adaptadores (Adapters)
# Cada adaptador faz um serviço incompatível "falar o idioma" da NotificationInterface.

class EmailAdapter(NotificationInterface):
    # Adapta o EmailService à NotificationInterface.
    def __init__(self, email_service: EmailService):
        self.email_service = email_service

    def send(self, message: str):
        # Traduz a chamada 'send' para 'send_email'.
        subject = "Você tem uma nova notificação"
        self.email_service.send_email(subject, message)

class SMSAdapter(NotificationInterface):
    # Adapta o SMSService à NotificationInterface.
    def __init__(self, sms_service: SMSService, phone_number: str):
        self.sms_service = sms_service
        self.phone_number = phone_number # O número de telefone pode ser configurado aqui

    def send(self, message: str):
        # Traduz a chamada 'send' para 'send_sms'.
        self.sms_service.send_sms(self.phone_number, message)

class TwitterAdapter(NotificationInterface):
    # Adapta o TwitterService à NotificationInterface.
    def __init__(self, twitter_service: TwitterService):
        self.twitter_service = twitter_service

    def send(self, message: str):
        # Traduz a chamada 'send' para 'post_tweet'.
        self.twitter_service.post_tweet(message)



# Integração e Testes (O Cliente usando os adaptadores)

print("Inicializando serviços e adaptadores...\n")

# Serviços originais
email_service = EmailService()
sms_service = SMSService()
twitter_service = TwitterService()

# Criando os adaptadores e "conectando" cada um ao seu respectivo serviço
# Agora todos eles "parecem" ser do tipo NotificationInterface
email_notifier = EmailAdapter(email_service)
sms_notifier = SMSAdapter(sms_service, phone_number="5514999998888")
twitter_notifier = TwitterAdapter(twitter_service)

# Junta os notifiers em um array para iniciar o envio em massa
notificadores = [email_notifier, sms_notifier, twitter_notifier]

# Define a mensagem a ser disparada por todos os notifiers
mensagem_global = "Promoção imperdível! Use o cupom DEV25 para 25% de desconto."

print(">>> Disparando notificações para todos os canais <<<\n")
for notificador in notificadores:
    # O cliente trata todos da mesma forma, graças ao Adapter.
    notificador.send(mensagem_global)