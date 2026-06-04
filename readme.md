# Pasos para deploy en k3s

1. Crear archivo .env con credenciales
2. Crear secrets
 k3s kubectl create secret generic tomanotas-secrets --from-file=.env=./.env -n prod
3. Hacer deploy de los cambios
 k3s kubectl apply -k deploy/overlays/prod -n prod

