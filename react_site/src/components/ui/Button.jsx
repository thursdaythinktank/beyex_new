import { motion } from 'framer-motion';

/**
 * Apple-inspired button component
 * Variants: primary (blue), secondary (gray outline)
 * Sizes: sm, md, lg
 */
export function Button({
  children,
  variant = 'primary',
  size = 'md',
  className = '',
  onClick,
  type = 'button',
  ...props
}) {
  const baseStyles = 'inline-flex items-center justify-center font-medium rounded-lg transition-all gpu-accelerated';

  const variants = {
    primary: 'bg-apple-blue-500 text-white hover:bg-apple-blue-600 active:scale-95',
    secondary: 'bg-transparent text-apple-gray-900 border border-apple-gray-300 hover:border-apple-gray-400 hover:bg-apple-gray-50 active:scale-95',
  };

  const sizes = {
    sm: 'px-4 py-2 text-sm',
    md: 'px-6 py-3 text-base',
    lg: 'px-8 py-4 text-lg',
  };

  return (
    <motion.button
      type={type}
      className={`${baseStyles} ${variants[variant]} ${sizes[size]} ${className}`}
      onClick={onClick}
      whileHover={{ scale: 1.02 }}
      whileTap={{ scale: 0.98 }}
      transition={{ type: 'spring', stiffness: 400, damping: 17 }}
      {...props}
    >
      {children}
    </motion.button>
  );
}
