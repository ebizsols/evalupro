valuation module entry
1- add data in modules table
INSERT INTO `modules` (`id`, `module_name`, `description`, `created_at`, `updated_at`) VALUES (NULL, 'valuation', 'valuation', NULL, NULL);

2- add in module_settings
INSERT INTO `module_settings` (`id`, `company_id`, `module_name`, `status`, `type`, `created_at`, `updated_at`) VALUES (NULL, '1', 'valuation', 'active', 'admin', NULL, NULL);
INSERT INTO `module_settings` (`id`, `company_id`, `module_name`, `status`, `type`, `created_at`, `updated_at`) VALUES (NULL, '1', 'valuation', 'active', 'employee', NULL, NULL);

