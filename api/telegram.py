import telebot

TOKEN = '898051088:AAGvfkawDAtl4TnRgkmxpGLel1kIkhD41LY'
bot = telebot.TeleBot(TOKEN)


# Echo
@bot.message_handler(func=lambda message: True)
def echo_all(message):
    bot.reply_to(message, message.text)


import time


@bot.message_handler(commands=['start', 'help'])
def send_welcome(message):
    bot.reply_to(message, "Howdy, how are you doing?")


@bot.message_handler(commands=['die'])
def send_welcome(message):
    time.sleep(3)
    bot.reply_to(message, "Dieing...")
    exit()


bot.polling()