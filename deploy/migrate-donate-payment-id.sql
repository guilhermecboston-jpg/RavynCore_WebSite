-- Stripe Checkout session id (cs_live_...) precisa de mais de 64 caracteres
ALTER TABLE `ravyn_donate_orders` MODIFY `payment_id` VARCHAR(255) NULL DEFAULT NULL;
