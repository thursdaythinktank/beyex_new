/**
 * Apple-inspired form input components
 * Consistent styling with focus states
 */
import { useId } from 'react';

export function Input({
  label,
  type = 'text',
  placeholder,
  value,
  onChange,
  required = false,
  className = '',
  id,
  ...props
}) {
  const generatedId = useId();
  const inputId = id || generatedId;
  return (
    <div className="space-y-2">
      {label && (
        <label htmlFor={inputId} className="block text-sm font-medium text-apple-gray-700">
          {label}
          {required && <span className="text-apple-blue-500 ml-1">*</span>}
        </label>
      )}
      <input
        id={inputId}
        type={type}
        placeholder={placeholder}
        value={value}
        onChange={onChange}
        required={required}
        className={`
          w-full px-4 py-3
          bg-apple-gray-100
          border border-apple-gray-300
          rounded-lg
          text-base text-apple-gray-900
          placeholder:text-apple-gray-400
          focus:bg-white
          focus:border-apple-blue-500
          focus:ring-4
          focus:ring-apple-blue-500/10
          focus:outline-none
          transition-all
          ${className}
        `}
        {...props}
      />
    </div>
  );
}

export function Textarea({
  label,
  placeholder,
  value,
  onChange,
  rows = 4,
  required = false,
  className = '',
  id,
  ...props
}) {
  const generatedId = useId();
  const inputId = id || generatedId;
  return (
    <div className="space-y-2">
      {label && (
        <label htmlFor={inputId} className="block text-sm font-medium text-apple-gray-700">
          {label}
          {required && <span className="text-apple-blue-500 ml-1">*</span>}
        </label>
      )}
      <textarea
        id={inputId}
        placeholder={placeholder}
        value={value}
        onChange={onChange}
        rows={rows}
        required={required}
        className={`
          w-full px-4 py-3
          bg-apple-gray-100
          border border-apple-gray-300
          rounded-lg
          text-base text-apple-gray-900
          placeholder:text-apple-gray-400
          focus:bg-white
          focus:border-apple-blue-500
          focus:ring-4
          focus:ring-apple-blue-500/10
          focus:outline-none
          transition-all
          resize-none
          ${className}
        `}
        {...props}
      />
    </div>
  );
}

export function Select({
  label,
  options = [],
  value,
  onChange,
  required = false,
  className = '',
  id,
  ...props
}) {
  const generatedId = useId();
  const inputId = id || generatedId;
  return (
    <div className="space-y-2">
      {label && (
        <label htmlFor={inputId} className="block text-sm font-medium text-apple-gray-700">
          {label}
          {required && <span className="text-apple-blue-500 ml-1">*</span>}
        </label>
      )}
      <select
        id={inputId}
        value={value}
        onChange={onChange}
        required={required}
        className={`
          w-full px-4 py-3
          bg-apple-gray-100
          border border-apple-gray-300
          rounded-lg
          text-base text-apple-gray-900
          focus:bg-white
          focus:border-apple-blue-500
          focus:ring-4
          focus:ring-apple-blue-500/10
          focus:outline-none
          transition-all
          ${className}
        `}
        {...props}
      >
        {options.map((option) => (
          <option key={option.value} value={option.value}>
            {option.label}
          </option>
        ))}
      </select>
    </div>
  );
}
