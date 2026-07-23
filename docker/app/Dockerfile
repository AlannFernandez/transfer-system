FROM node:20-alpine

WORKDIR /app

# Instalar herramientas necesarias
RUN npm install -g expo-cli

# Copiar manifiestos
COPY package*.json ./

# Instalar dependencias
RUN npm install

# Copiar el resto del código
COPY . .

# Puertos de Expo / Metro Bundler
EXPOSE 8081
EXPOSE 19000
EXPOSE 19001
EXPOSE 19002

CMD ["npx", "expo", "start", "--tunnel"]